'use strict';
//var React = require('react');
//var $ = require("jquery");
//var moment = require("moment");

var RegisterBox = React.createClass({
    checkFlag: false,
    mail: '',
    pwd: '',
    username: '',
    pwd_confirmation: '',
    getInitialState: function () {
        return {
            token: '',
            warning: {},
            applyMsg: {}
        };
    },
    submit: function () {

        this.checkFlag = true;

        if (this.isInputLegal()) {

            //return $.ajax({
            //
            //    url: this.props.urlRegister,
            //    method: 'post',
            //    dataType: 'json',
            //    data: {
            //        mail: this.mail,
            //        pwd: this.pwd,
            //        name: this.username,
            //    }
            //
            //}).done(function (data) {
            //
            //    if (data.errno == 0) {
            //
            //        this.setState({
            //            applyMsg: {
            //                apply: data.msg
            //            }
            //        });
            //        setTimeout(function () {
            //
            //            window.location.href = this.props.urlRedirect;
            //
            //        }.bind(this), 100);
            //
            //    } else {
            //        this.setState({
            //            warning: {
            //                apply: data.msg
            //            }
            //        });
            //    }
            //
            //}.bind(this)).fail(function (xhr, status, err) {
            //
            //    console.error(this.props.url, status, err);
            //    this.setState({
            //        warning: {
            //            apply: '出现了一些问题'
            //        }
            //    });
            //
            //});
            return true;

        } else {

            return false;

        }

    },
    isInputLegal: function () {

        if (!this.checkFlag) {
            return false;
        }

        var mail = this.mail = this.refs.mail.getDOMNode().value.trim();
        var pwd = this.pwd = this.refs.pwd.getDOMNode().value.trim();
        var pwd_confirmation = this.pwd_confirmation = this.refs.pwd_confirmation.getDOMNode().value.trim();
        var username = this.username = this.refs.username.getDOMNode().value.trim();

        var regEmpty = /^\s*$/;
        var regMail = /^.+\@.+$/;

        var flag = true;

        if (regEmpty.test(username)) {
            this.setState({
                warning: {
                    username: '请输入用户名'
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
                    mail: '请输入邮箱'
                }
            });
            return false;
        } else if (!regMail.test(mail)) {
            this.setState({
                warning: {
                    mail: '不是一个合法的邮箱'
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
                    pwd: '请输入密码'
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

        if (regEmpty.test(pwd_confirmation)) {
            this.setState({
                warning: {
                    pwd_confirmation: '请确认密码'
                }
            });
            return false;
        } else if (pwd !== pwd_confirmation) {
            this.setState({
                warning: {
                    pwd_confirmation: '密码不一致'
                }
            });
            return false;
        } else {
            this.setState({
                warning: {
                    pwd_confirmation: ''
                }
            });
        }

        return flag;

    },
    componentDidMount: function () {
        this.setState({
            token: $('meta[name="csrf-token"]').attr('content')
        });
    },
    componentWillUnmount: function () {

    },
    render: function () {
        return (
            <div className="main-box">
                <h4>注册</h4>

                <form className="login-box" action={this.props.urlRegister} method="POST" onSubmit={this.submit}>
                    <input type="hidden" name="_token" value={this.state.token}/>

                    <div className="item">
                        <label htmlFor="username">用户名 : </label>
                        <input className="text-input" ref="username" type="text" id="username" name="name"
                               onChange={this.isInputLegal}
                               placeholder="用户名"/>

                        <p className="warning">{this.state.warning.username}</p>
                    </div>

                    <div className="item">
                        <label htmlFor="mail">邮箱 : </label>
                        <input className="text-input" ref="mail" type="text" id="mail" name="email"
                               onChange={this.isInputLegal}
                               placeholder="登录邮箱"/>

                        <p className="warning">{this.state.warning.mail}</p>
                    </div>

                    <div className="item">
                        <label htmlFor="pwd">密码 : </label>
                        <input className="text-input" ref="pwd" type="password" name="pwd" name="password"
                               onChange={this.isInputLegal}
                               placeholder="登录密码"/>

                        <p className="warning">{this.state.warning.pwd}</p>
                    </div>

                    <div className="item">
                        <label htmlFor="pwd">确认密码 : </label>
                        <input className="text-input" ref="pwd_confirmation" type="password" name="pwd"
                               name="password_confirmation"
                               onChange={this.isInputLegal}
                               placeholder="登录密码"/>

                        <p className="warning">{this.state.warning.pwd_confirmation}</p>
                    </div>

                    <div className="item">
                        <button className="btn">注册</button>
                        <p className="warning">{this.state.warning.apply}</p>

                        <p className="msg">{this.state.applyMsg.apply}</p>
                    </div>
                </form>
            </div>
        );
    }
});

module.exports = RegisterBox;