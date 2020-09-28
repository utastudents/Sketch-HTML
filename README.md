# Sketch-HTML
 ![](https://img.shields.io/badge/python-3-brightgreen.svg) ![](https://img.shields.io/badge/php-7-orange.svg)


An automation tool for developing front-end html skeleton by sketching a blueprint on a piece of paper.

## Description

Sketch-HTML is an automated tool which converts a sketch or a blueprint design into an HTML skeleton. 
It uses openCV library to detect the shapes drawn on a piece of paper. And these shapes are mapped to HTML Bootstrap elements as follows:

Rectangle => Header,
Circle => Slider,
Pentagon => Footer,
Square => Card,
Hexagon => Team Box,
Triangle => Service Box.

Here shapes are on the left side which are mapped to their respective html elements.

# Example Usage

## Getting the files
```
git clone https://github.com/harshchaludia/Sketch-HTML.git
```

## Choose an image or Sketch one.
1. After choosing or sketching the document (png or jpg), upload it in the image folder inside shape directory
2. Edit the code(index.php line-23) by changing the image name inside the 'escapeshellcmd' in php
3. Run it in localhost

## Prerequisites
- Python 3 (not compatible with python 2)
- pip
- Php

## Purpose

Developed this project at HACKUTA hackathon event at University of Texas -- Arlington.
Were selected in the top 7 out of all the teams participated at this event.
