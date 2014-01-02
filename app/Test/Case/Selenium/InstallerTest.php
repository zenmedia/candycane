<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yandod
 * Date: 2014/01/02
 * Time: 20:05
 * To change this template use File | Settings | File Templates.
 * mysql -u root -e "drop database if exists test_candycane;create database test_candycane;"; ./vendor/bin/phpunit app/Test/Case/Selenium/InstallerTest.php
 *
 */
class InstallerTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected $captureScreenshotOnFailure = TRUE;
    protected $screenshotPath = '/tmp';
    protected $screenshotUrl = 'http://localhost/screenshots';

    protected function setUp()
    {
        $this->setHost('127.0.0.1');
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://127.0.0.1:80/');
    }

    public function testInstallMySQL()
    {
        $this->url('/cc_install/cc_install/');
        $this->assertEquals('Installation: Welcome - CandyCane', $this->title());

        $link = $this->byId('next-link');
        $this->moveto($link);
        $this->click();
        $this->assertEquals('Step 1: Database - CandyCane', $this->title());

        $this->select($this->byId('InstallDatasource'))->selectOptionByValue("mysql");
        $input = $this->byId('InstallDatabase');
        $input->clear();
        $input->value('test_candycane');
        $form = $this->byId('InstallDatabaseForm');
        $form->submit();

        $this->timeouts()->implicitWait(1500);
        $this->assertEquals('Step 2: Run SQL - CandyCane', $this->title());

        $link = $this->byId('run-link');
        $this->moveto($link);
        $this->click();
        $this->timeouts()->implicitWait(1500);

        $this->url('/account/login');
        $this->byId('username')->value('admin');
        $this->byId('UserPassword')->value('admin');
        $button = $this->byName('login');
        $this->moveto($button);
        $this->click();
        //$this->byId('UserLoginForm')->submit();

        $this->timeouts()->implicitWait(1000);

        //$link = $this->byClassName('administration');
        //$link = $this->byLinkText('Administration');
        //$this->moveto($link);
        //$this->click();

        $this->assertEquals('/admin', $this->url());








    }
}