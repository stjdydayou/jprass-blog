(function($) {

	'use strict';

	$.validate = function() {
		$("form").bind('submit', function() {
			var $form = $(this);
			$form.find('input,textarea,select').filter(':not([type="submit"],[type="button"])').each(function() {
				var $element = $(this);

				var elementType = $element.attr('type');

				if (!$.formUtils.ignoreInput(elementType)) {

					var validation = $.formUtils.validateInput($element, $form);
					if (validation !== true) {
						$element.addClass($.formUtils.defaultConfig.errorElementClass).css('border-color', $.formUtils.defaultConfig.borderColorOnError);
						$.formUtils.showMsg("error", validation);
						$.formUtils.haltValidation = true;
						return false;
					}
					$element.removeClass($.formUtils.defaultConfig.errorElementClass).css('border-color', '');
					$.formUtils.hideMsg();
				}
			});
			if ($.formUtils.haltValidation) {
				$.formUtils.haltValidation = false;
				return false;
			}
		});
	};
	/**
	 * Default config for $(...).validateForm();
	 */
	$.formUtils = {
		/**
		 * Default config for $(...).validateForm();
		 */
		defaultConfig: {
			errorElementClass: 'error', // Class that will be put on elements which value is invalid
			borderColorOnError: 'red', // Border color of elements which value is invalid, empty string to not change border color
			validationRuleAttribute: 'data-rule', // name of the attribute holding the validation rules
			messageShow: "#validator-msg",
			errorMessageClass: "validator-error",
			okMessageClass: "validator-error"
//			dateFormat: 'yyyy-mm-dd',
		},
		/**
		 * Setting this property to true during validation will
		 * stop further validation from taking place and form will
		 * not be sent
		 */
		haltValidation: false,
		/**
		 * 定时隐藏消息执行器
		 */
		timeouter: null,
		/**
		 * Available validators
		 */
		validators: {},
		/**
		 * Function for adding a validator
		 * @param {Object} validator
		 */
		addValidator: function(validator) {
			// prefix with "validate_" for backward compatibility reasons
			var name = validator.name.indexOf('validate_') === 0 ? validator.name : 'validate_' + validator.name;
			this.validators[name] = validator;
		},
		/**
		 * Tells whether or not to validate element with this name and of this type
		 *
		 * @param {String} type
		 * @return {Boolean}
		 */
		ignoreInput: function(type) {

			if (type === 'submit' || type === 'button') {
				return true;
			}
			return false;
		},
		/**
		 * 显示提示消息
		 * @param {String} type
		 * @param {String} message
		 */
		showMsg: function(type, message) {
			if ($($.formUtils.defaultConfig.messageShow).length < 0) {
				$(document).append('<div id="validator-msg" style="display: none"></div>');
			}
			if ("error" === type) {
				$($.formUtils.defaultConfig.messageShow).html(message).show().addClass($.formUtils.defaultConfig.errorMessageClass);
			}
			if ("ok" === type) {
				$($.formUtils.defaultConfig.messageShow).html(message).show().addClass($.formUtils.defaultConfig.okMessageClass);
			}
			clearTimeout(this.timeouter);
			this.timeouter = setTimeout("$.formUtils.hideMsg()", 10000);
		},
		/**
		 * 隐藏提示消息
		 */
		hideMsg: function() {
			$($.formUtils.defaultConfig.messageShow).html("").hide();
		},
		/**
		 * Validate the value of given element according to the validation rules
		 * found in the attribute data-rule. Will return true if valid,
		 * error message otherwise
		 *
		 * @param {jQuery} $element
		 * @param {jQuery} $form
		 * @return {String|Boolean}
		 */
		validateInput: function($element, $form) {

			var value = $.trim($element.val() || '');

			var validationRules = $element.attr(this.defaultConfig.validationRuleAttribute),
					validationErrorMsg = true;

			if (!validationRules)
				return true;


			$.split(validationRules, function(rule) {

				var rDisplay = /(?:([^:\[]*):)?\s*(.*)/,
						ruleArr = rDisplay.exec(rule);

				rule = ruleArr[2];
				if (rule.indexOf('validate_') !== 0) {
					rule = 'validate_' + rule;
				}

				var validator = $.formUtils.validators[rule];

				if (validator && typeof validator['validatorFunction'] === 'function') {

					var isValid = validator.validatorFunction(value, $element);

					if (!isValid) {
						validationErrorMsg = validator.errorMessage.replace('{0}', ruleArr[1] || '');
						return false;
					}

				} else {
					console.warn('Using undefined validator "' + rule + '"');
				}

			}, ' ');

			if (typeof validationErrorMsg === 'string') {
				return validationErrorMsg;
			} else {
				return true;
			}
		}
	};
	/**
	 * Short hand for fetching/adding/removing element attributes
	 * prefixed with 'data-rule-'
	 *
	 * @param {String} name
	 * @param {String|Boolean} [val]
	 * @return string|undefined
	 * @protected
	 */
	$.fn.valAttr = function(name, val) {
		if (val === undefined) {
			return this.attr('data-rule-' + name);
		} else if (val === false || val === null) {
			return this.removeAttr('data-rule-' + name);
		} else {
			if (name.length > 0)
				name = '-' + name;
			return this.attr('data-rule' + name, val);
		}
	};
	/**
	 * A bit smarter split function
	 * @param {String} val
	 * @param {Function|String} [func]
	 * @param {String} [delim]
	 * @returns {Array|void}
	 */
	$.split = function(val, func, delim) {
		if (typeof func !== 'function') {
			// return string
			if (!val)
				return [];
			var values = [];
			$.each(val.split(func ? func : ','), function(i, str) {
				str = $.trim(str);
				if (str.length)
					values.push(str);
			});
			return values;
		} else if (val) {
			// use callback on each
			if (!delim)
				delim = ',';
			$.each(val.split(delim), function(i, str) {
				str = $.trim(str);
				if (str.length)
					return func(str, i);
			});
		}
	};

	/*
	 * Validate required
	 */
	$.formUtils.addValidator({
		name: 'required',
		validatorFunction: function(val, $el) {
			return $el.attr('type') === 'checkbox' ? $el.is(':checked') : $.trim(val) !== '';
		},
		errorMessage: '{0}不能为空！'
	});
	/*
	 * Validate url
	 */
	$.formUtils.addValidator({
		name: 'url',
		validatorFunction: function(url) {
			var urlFilter = /^(https?|ftp):\/\/[^\s]*$/i;
			if (urlFilter.test(url)) {
				return true;
			}
			return false;
		},
		errorMessage: '{0}不是一个正确的URL地址！'
	});
	/*
	 * Validate email
	 */
	$.formUtils.addValidator({
		name: 'email',
		validatorFunction: function(email) {
			var emailFilter = /^(?:[a-z0-9]+[_\-+.]?)*[a-z0-9]+@(?:([a-z0-9]+-?)*[a-z0-9]+.)+([a-z]{2,})+$/i;
			if (emailFilter.test(email)) {
				return true;
			}
			return false;
		},
		errorMessage: '{0}格式不正确！请输入正确的邮箱地址！'
	});

	/*
	 * Validate against regexp
	 */
	$.formUtils.addValidator({
		name: 'custom',
		validatorFunction: function(val, $el) {
			var regexp = new RegExp($el.valAttr('regexp'));
			return regexp.test(val);
		},
		errorMessage: '{0}格式不正确！'
	});

	/*
	 * Validate username
	 */
	$.formUtils.addValidator({
		name: 'username',
		validatorFunction: function(username) {
			var usernameFilter = /^\w{3,12}$/;
			if (usernameFilter.test(username)) {
				return true;
			}
			return false;
		},
		errorMessage: '{0}格式不正确！请输入3-12位数字、字母、下划线'
	});
	/*
	 * Validate password
	 */
	$.formUtils.addValidator({
		name: 'password',
		validatorFunction: function(password) {
			var passwordFilter = /^[0-9a-zA-Z]{6,16}$/;
			if (passwordFilter.test(password)) {
				return true;
			}
			return false;
		},
		errorMessage: '{0}格式不正确！请输入6-16位数字、字母组成'
	});
	/*
	 * Validate captcha
	 */
	$.formUtils.addValidator({
		name: 'captcha',
		validatorFunction: function(password) {
			var passwordFilter = /^[0-9a-zA-Z]{4,6}$/;
			if (passwordFilter.test(password)) {
				return true;
			}
			return false;
		},
		errorMessage: '{0}格式不正确！请输入正确的验证码'
	});

	/*
	 * Validate against match
	 */
	$.formUtils.addValidator({
		name: 'match',
		validatorFunction: function(val, $el) {
			var match = $el.valAttr('match');
			return val === $(match).val();
		},
		errorMessage: '{0}输入错误！'
	});
})(jQuery);