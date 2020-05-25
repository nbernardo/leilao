<?php

//namespace Apllication;

/**
* 
*/
class Configuration {

	private static $name = 'E-Commerce';
	private static $url = 'http://localhost:8000/e-commerce';
	private static $base = '/e-commerce';
	private static $css_dir = 'http://localhost:8000/e-commerce/assets/css';
	private static $js_dir = 'http://localhost:8000/e-commerce/assets/js';
	private static $fonts_dir = 'http://localhost:8000/e-commerce/assets/fonts';
	private static $img_dir = 'http://localhost:8000/e-commerce/storage';

	public static function name() { return self::$name;	}
	public static function url() { return "http://" . $_SERVER['HTTP_HOST'] . self::$base;}
	public static function base() {	/*return self::$base;*/	}
	public static function css_dir() { return self::$css_dir; }
	public static function img_dir() {	return self::$img_dir;	}
	public static function fonts_dir()	{ return self::$fonts_dir;	}
	public static function js_dir()	{ return self::$js_dir;	}
	
	public static function baseUrl(){
		return "http://" . $_SERVER['HTTP_HOST']."/";
	}

	public static function fileSystemPath(){
		return $_SERVER["DOCUMENT_ROOT"];
	}

	public static function pagesPath(){
		return $_SERVER["DOCUMENT_ROOT"]."/Pages/";
	}

	
	public static function assetsPath(){
		return $_SERVER["DOCUMENT_ROOT"]."/assets/";
	}
	
}