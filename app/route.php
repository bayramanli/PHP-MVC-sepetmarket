<?php
App::getAction("/", "/");
App::getAction("/index", "/default/index");
App::getAction("/login", "/default/login");
App::postAction("/login", "/default/loginControl");
App::getAction("/logout", "/default/logout");
App::getAction("/basket", "/default/basket", true, "frontend");
App::getAction("/basketlogin", "/default/basketLoginControl");
App::postAction("/addproduct", "/default/addProductToBasket", true, "frontend");
App::getAction("/basketplus/([0-9a-zA-z-_]+)/([0-9a-zA-z-_]+)", "/default/basketPlus/([0-9a-zA-z-_]+)/([0-9a-zA-z-_]+)", true, "frontend");
App::getAction("/basketminus/([0-9a-zA-z-_]+)/([0-9a-zA-z-_]+)", "/default/basketMinus/([0-9a-zA-z-_]+)/([0-9a-zA-z-_]+)", true, "frontend");
App::postAction("/basketdrop", "/default/basketDrop", true, "frontend");