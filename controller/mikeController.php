<?php
class mikeController extends base_controller{
	public function indexAction(){
		echo "Hello guys";
	}
	public function errorAction(){
		echo "some error";
	}
	public function speak_tomAction(){
		echo "My name is <h1>kenny</h1>";
	}
	
	public function infoAction(){
		echo "some info here";
	}
}