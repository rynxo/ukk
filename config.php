<?php

session_start();

$con = new mysqli("localhost", "root", "", "sr");

const BASE = "http://localhost/SR/";

date_default_timezone_set("Asia/Jakarta");
