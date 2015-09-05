'use strict';
var React = require('react');
var LoginBox = require('./login_react');
var RegisterBox = require('./register_react');

var LoginRegisterBox = React.createClass({
    render: function () {
        return (
            <div>
                <LoginBox urlLogin='/index/login' urlRedirect="/list"/>
                <RegisterBox urlRegister='/index/register' urlRedirect="/list"/>
            </div>
        );
    }
});

React.render(
    <LoginRegisterBox/>,
    document.getElementById('wrapper')
);