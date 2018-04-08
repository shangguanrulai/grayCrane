<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='7a7e15eff9fe00d980a3b3ada8dd0381';
//填写在开发者控制台首页上的Auth Token
$options['token']='4906896f01ae877072d36469df893fae';

//初始化 $options必填
$ucpass = new Ucpaas($options);