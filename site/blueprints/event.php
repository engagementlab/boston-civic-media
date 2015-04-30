<?php if(!defined('KIRBY')) exit ?>

title: Event
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  speaker:
  	label: Speaker
  	type: text
  linktext:
    label: Name of speaker's website or organization website
    type: text
    width: 1/2
  speakerlink:
    label: URL
    type: url
    width: 1/2
  time:
    label: Time
    type: time
    interval: 15
  description:
    label: Description
    type: textarea
  keywords:
    label: Keywords
    type: tags
    lowercase: true
