"use strict";!function(){new Plyr("#plyr-video-player");document.getElementsByClassName("plyr")[0].style.borderRadius="7px",document.getElementsByClassName("plyr__poster")[0].style.display="none";const e=document.getElementsByTagName("html")[0],t=document.querySelector(".stick-top");function s(){e.classList.contains("layout-navbar-fixed")?t.classList.add("course-content-fixed"):t.classList.remove("course-content-fixed")}s(),window.onscroll=function(){s()}}();