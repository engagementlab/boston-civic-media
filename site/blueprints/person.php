<?php if(!defined('KIRBY')) exit ?>

title: Person
pages: false
files: true
fields:
  title:
    label: Name
    type:  text
  role:
  	label: Title
  	type: text
  organization:
    label: Institution, Company, or Organization
    type: text
  universityboolean:
    label: University members
    type: checkbox
    text: I am affiliated with a college or university
  bio:
    label: Bio
    type: textarea
  researchinterests: 
    label: Research Interests
    type: tags
    lowercase: true
  twitter:
    label: Twitter
    type: url
    width: 1/3
  linkedin:
    label: LinkedIn
    type: url
    width: 1/3
  website:
    label: Website
    type: url
    width: 1/3
