### Project Lambo

## On Point Detailing Website Update

On Point Detailing's new website will provide:
- A mobile version for easy use on phones/tablets
- Information on various services
- A way for customers to schedule appointments
- Social media integration
- Database administration

## Installation instructions

This was designed for a LAMP stack and requires at least php 5.4

1. Create a google service account  
a. Go to https://console.developers.google.com/  
b. Create a new project  
c. On the left side click "APIs & Auth" and then "Credentials"  
d. Add Credentials "Service Account" and pick JSON  
e. Press "create"  
f. Rename the JSON file that was automatically downloaded to "client_secrets.json"  
g. On the credentials page, click on your newly created service account.  
h. Take note of the Client ID and email  

2. Place client_secrets.json in the www directory

3. Extract google-api-client-v2.0.0-RC2.zip in the current directory  
a. You will end up with a structure like so  
![alt tag](https://raw.github.com/asu-cis-capstone/lambo/master/Support Documents/filestructure.jpg)

4. Edit DBInfo.template with your information and save it as "DBInfo.config"

5. Edit the settings for the google calendar where you will store the information  
a. Under google calendar's settings, press the calendars tab.  
b. Click on your calendar's name  
c. Go to the "share this calendar" tab  
d. Check both the "make this calendar public" and "only share free/busy information"  
e. Under "share with specific people" enter the email from the service account.  
f. Change permission settings to "make changes to events" then add person.  
g. Press save.  

6. Place the contents of the www directory in your web server's root.

## Project Team

Zachary Baumgartner  
Skyler Hewitt        
Xiaotong (Sarah) Liu  
Siqian (Jackie) Tong  
Xuewei (Summer) Zhu  

 
### Waffle.io Task Board

[![Stories in Ready](https://badge.waffle.io/asu-cis-capstone/lambo.svg?label=ready&title=Ready)](http://waffle.io/asu-cis-capstone/lambo)
