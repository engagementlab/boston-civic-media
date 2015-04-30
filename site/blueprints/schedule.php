<?php if(!defined('KIRBY')) exit ?>

title: Page
pages: 
  sortable: true
  sort: time asc
  template:
    - event
files: true
fields:
  title:
    label: Title
    type:  text
  text:
    label: Text
    type:  textarea