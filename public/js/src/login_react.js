'use strict';
//var React = require('react');
//var $ = require("jquery");
//var moment = require("moment");

var LoginBox = React.createClass({
    checkFlag: false,
    mail: '',
    pwd: '',
    getInitialState: function () {
        return {
            token: '',
            warning: {},
            applyMsg: {
                apply: ''
            }
        };
    },
    submit: function () {

        this.checkFlag = true;

        if (this.isInputLegal()) {

            //return $.ajax({
            //
            //    url: this.props.urlLogin,
            //    method: 'post',
            //    dataType: 'json',
            //    data: {
            //        mail: this.mail,
            //        pwd: this.pwd
            //    }
            //
            //}).done(function (data) {
            //
            //    if (data.errno == 0) {
            //
            //        this.setState({
            //            warning: {
            //                apply: ''
            //            },
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
                <h4>登录</h4>

                <form className="login-box" action={this.props.urlLogin} method="POST" onSubmit={this.submit}>
                    <input type="hidden" name="_token" value={this.state.token}/>

                    <div className="item">
                        <label htmlFor="mail">邮箱 : </label>
                        <input className="text-input" ref="mail" type="text" id="mail" name="email"
                               onChange={this.isInputLegal} placeholder="登录邮箱"/>

                        <p className="warning">{this.state.warning.mail}</p>
                    </div>
                    <div className="item">
                        <label htmlFor="password">密码 : </label>
                        <input className="text-input" ref="pwd" type="password" name="password"
                               onChange={this.isInputLegal} placeholder="登录密码"/>

                        <p className="warning">{this.state.warning.pwd}</p>
                    </div>
                    <div className="item">
                        <input className="remember" type="checkbox" name="remember"/>
                        <span>记住我</span>
                    </div>
                    <div className="item">
                        <button className="btn">登录</button>
                        <p className="warning">{this.state.warning.apply}</p>

                        <p className="msg">{this.state.applyMsg.apply}</p>
                    </div>
                </form>
            </div>
        );
    }
});

module.exports = LoginBox;