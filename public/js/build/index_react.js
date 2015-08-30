webpackJsonp([1],{

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var React = __webpack_require__(1);
	var LoginBox = __webpack_require__(246);
	var RegisterBox = __webpack_require__(247);

	var LoginRegisterBox = React.createClass({
	    displayName: 'LoginRegisterBox',

	    render: function render() {
	        return React.createElement(
	            'div',
	            null,
	            React.createElement(LoginBox, { urlLogin: '/index/login', urlRedirect: '/list' }),
	            React.createElement(RegisterBox, { urlRegister: '/index/register', urlRedirect: '/list' })
	        );
	    }
	});

	React.render(React.createElement(LoginRegisterBox, null), document.getElementById('wrapper'));

/***/ },

/***/ 246:
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var React = __webpack_require__(1);
	var $ = __webpack_require__(157);
	var moment = __webpack_require__(158);

	var LoginBox = React.createClass({
	    displayName: 'LoginBox',

	    checkFlag: false,
	    mail: '',
	    pwd: '',
	    getInitialState: function getInitialState() {
	        return {
	            warning: {},
	            applyMsg: {
	                apply: ''
	            }
	        };
	    },
	    submit: function submit() {

	        this.checkFlag = true;

	        if (this.isInputLegal()) {

	            return $.ajax({

	                url: this.props.urlLogin,
	                method: 'post',
	                dataType: 'json',
	                data: {
	                    mail: this.mail,
	                    pwd: this.pwd
	                }

	            }).done((function (data) {

	                if (data.errno == 0) {

	                    this.setState({
	                        warning: {
	                            apply: ''
	                        },
	                        applyMsg: {
	                            apply: data.msg
	                        }
	                    });
	                    setTimeout((function () {

	                        window.location.href = this.props.urlRedirect;
	                    }).bind(this), 100);
	                } else {
	                    this.setState({
	                        warning: {
	                            apply: data.msg
	                        }
	                    });
	                }
	            }).bind(this)).fail(function (xhr, status, err) {

	                console.error(this.props.url, status, err);
	                this.setState({
	                    warning: {
	                        apply: '出现了一些问题'
	                    }
	                });
	            });
	        }
	    },
	    isInputLegal: function isInputLegal() {

	        if (!this.checkFlag) {
	            return false;
	        }

	        var mail = this.mail = this.refs.mail.getDOMNode().value.trim();
	        var pwd = this.pwd = this.refs.pwd.getDOMNode().value.trim();

	        var regEmpty = /^\s*$/;
	        var regMail = /^.+\@.+$/;

	        var flag = true;

	        if (regEmpty.test(mail)) {
	            this.setState({
	                warning: {
	                    mail: '请输入您的邮箱'
	                }
	            });
	            return false;
	        } else if (!regMail.test(mail)) {
	            this.setState({
	                warning: {
	                    mail: '您输入的不是一个合法的邮箱'
	                }
	            });
	            return false;
	        } else {
	            this.setState({
	                warning: {
	                    mail: ''
	                }
	            });
	        }

	        if (regEmpty.test(pwd)) {
	            this.setState({
	                warning: {
	                    pwd: '请输入您的密码'
	                }
	            });
	            return false;
	        } else {
	            this.setState({
	                warning: {
	                    pwd: ''
	                }
	            });
	        }

	        return flag;
	    },
	    componentDidMount: function componentDidMount() {},
	    componentWillUnmount: function componentWillUnmount() {},
	    render: function render() {
	        return React.createElement(
	            'div',
	            { className: 'main-box' },
	            React.createElement(
	                'h4',
	                null,
	                '登录'
	            ),
	            React.createElement(
	                'div',
	                { className: 'login-box' },
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'label',
	                        { htmlFor: 'mail' },
	                        '邮箱 : '
	                    ),
	                    React.createElement('input', { ref: 'mail', type: 'text', id: 'mail', onChange: this.isInputLegal, placeholder: '登录邮箱' }),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.mail
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'label',
	                        { htmlFor: 'pwd' },
	                        '密码 : '
	                    ),
	                    React.createElement('input', { ref: 'pwd', type: 'password', name: 'pwd', onChange: this.isInputLegal, placeholder: '登录密码' }),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.pwd
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'button',
	                        { className: 'btn', onClick: this.submit },
	                        '登录'
	                    ),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.apply
	                    ),
	                    React.createElement(
	                        'p',
	                        { className: 'msg' },
	                        this.state.applyMsg.apply
	                    )
	                )
	            )
	        );
	    }
	});

	module.exports = LoginBox;

/***/ },

/***/ 247:
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var React = __webpack_require__(1);
	var $ = __webpack_require__(157);
	var moment = __webpack_require__(158);

	var RegisterBox = React.createClass({
	    displayName: 'RegisterBox',

	    checkFlag: false,
	    mail: '',
	    pwd: '',
	    username: '',
	    getInitialState: function getInitialState() {
	        return {
	            warning: {},
	            applyMsg: {}
	        };
	    },
	    submit: function submit() {

	        this.checkFlag = true;

	        if (this.isInputLegal()) {

	            return $.ajax({

	                url: this.props.urlRegister,
	                method: 'post',
	                dataType: 'json',
	                data: {
	                    mail: this.mail,
	                    pwd: this.pwd,
	                    name: this.username
	                }

	            }).done((function (data) {

	                if (data.errno == 0) {

	                    this.setState({
	                        applyMsg: {
	                            apply: data.msg
	                        }
	                    });
	                    setTimeout((function () {

	                        window.location.href = this.props.urlRedirect;
	                    }).bind(this), 100);
	                } else {
	                    this.setState({
	                        warning: {
	                            apply: data.msg
	                        }
	                    });
	                }
	            }).bind(this)).fail(function (xhr, status, err) {

	                console.error(this.props.url, status, err);
	                this.setState({
	                    warning: {
	                        apply: '出现了一些问题'
	                    }
	                });
	            });
	        }
	    },
	    isInputLegal: function isInputLegal() {

	        if (!this.checkFlag) {
	            return false;
	        }

	        var mail = this.mail = this.refs.mail.getDOMNode().value.trim();
	        var pwd = this.pwd = this.refs.pwd.getDOMNode().value.trim();
	        var username = this.username = this.refs.username.getDOMNode().value.trim();

	        var regEmpty = /^\s*$/;
	        var regMail = /^.+\@.+$/;

	        var flag = true;

	        if (regEmpty.test(username)) {
	            this.setState({
	                warning: {
	                    username: '请输入您的用户名'
	                }
	            });
	            return false;
	        } else {
	            this.setState({
	                warning: {
	                    username: ''
	                }
	            });
	        }

	        if (regEmpty.test(mail)) {
	            this.setState({
	                warning: {
	                    mail: '请输入您的邮箱'
	                }
	            });
	            return false;
	        } else if (!regMail.test(mail)) {
	            this.setState({
	                warning: {
	                    mail: '您输入的不是一个合法的邮箱'
	                }
	            });
	            return false;
	        } else {
	            this.setState({
	                warning: {
	                    mail: ''
	                }
	            });
	        }

	        if (regEmpty.test(pwd)) {
	            this.setState({
	                warning: {
	                    pwd: '请输入您的密码'
	                }
	            });
	            return false;
	        } else if (pwd.length < 6) {
	            this.setState({
	                warning: {
	                    pwd: '密码必须大于6位'
	                }
	            });
	            return false;
	        } else {
	            this.setState({
	                warning: {
	                    pwd: ''
	                }
	            });
	        }

	        return flag;
	    },
	    componentDidMount: function componentDidMount() {},
	    componentWillUnmount: function componentWillUnmount() {},
	    render: function render() {
	        return React.createElement(
	            'div',
	            { className: 'main-box' },
	            React.createElement(
	                'h4',
	                null,
	                '注册'
	            ),
	            React.createElement(
	                'div',
	                { className: 'register-box' },
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'label',
	                        { htmlFor: 'username' },
	                        '用户名 : '
	                    ),
	                    React.createElement('input', { ref: 'username', type: 'text', id: 'username', onChange: this.isInputLegal, placeholder: '用户名' }),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.username
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'label',
	                        { htmlFor: 'mail' },
	                        '邮箱 : '
	                    ),
	                    React.createElement('input', { ref: 'mail', type: 'text', id: 'mail', onChange: this.isInputLegal, placeholder: '登录邮箱' }),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.mail
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'label',
	                        { htmlFor: 'pwd' },
	                        '密码 : '
	                    ),
	                    React.createElement('input', { ref: 'pwd', type: 'password', name: 'pwd', onChange: this.isInputLegal, placeholder: '登录密码' }),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.pwd
	                    )
	                ),
	                React.createElement(
	                    'div',
	                    { className: 'item' },
	                    React.createElement(
	                        'button',
	                        { className: 'btn', onClick: this.submit },
	                        '注册'
	                    ),
	                    React.createElement(
	                        'p',
	                        { className: 'warning' },
	                        this.state.warning.apply
	                    ),
	                    React.createElement(
	                        'p',
	                        { className: 'msg' },
	                        this.state.applyMsg.apply
	                    )
	                )
	            )
	        );
	    }
	});

	module.exports = RegisterBox;

/***/ }

});