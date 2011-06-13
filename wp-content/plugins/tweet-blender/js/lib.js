/*
 * Library of shared JS functions and data structures
 */

// Fallback for sites not supporting wp_localize_script
if (typeof(TB_labels) == 'undefined') {
	var TB_labels = {
		no_config: "No configuration settings found",
		twitter_logo: "Twitter Logo",
		kino: "Development by Kirill Novitchenko",
		refresh: "Refresh",
		no_sources: "Twitter sources to blend are not defined",
		no_global_config: "Cannot retrieve Tweet Blender configuration options",
		version_msg: "Powered by Tweet Blender plugin v{0} blending {1}",
		limit_msg: "You reached Twitter API connection limit",
		no_tweets_msg: "No tweets found for {0}",
		loading_msg: "Loading tweets...",
		time_past: "{0} {1} ago",
		time_future: "in {0} {1}",
		second: "second",
		seconds: "seconds",
		minute: "minute",
		minutes: "minutes",
		hour: "hour",
		hours: "hours",
		day: "day",
		days: "days",
		week: "week",
		weeks: "weeks",
		month: "month",
		months: "months",
		year: "year",
		years: "years",
		check_fail: "Check failed",
		limit_num: "Max is {0}/hour",
		limit_left: "You have {0} left",
		from: "from",
		reply: "reply",
		follow: "follow",
		limit_reset: "Next reset"
	};
}

var TB_monthNumber = {'Jan':1,'Feb':2,'Mar':3,'Apr':4,'May':5,'Jun':6,'Jul':7,'Aug':8,'Sep':9,'Oct':10,'Nov':11,'Dec':12},
TB_timePeriods = new Array(TB_labels.second, TB_labels.minute, TB_labels.hour, TB_labels.day, TB_labels.week, TB_labels.month, TB_labels.year),
TB_timePeriodsPlural = new Array(TB_labels.seconds, TB_labels.minutes, TB_labels.hours, TB_labels.days, TB_labels.weeks, TB_labels.months, TB_labels.years),
TB_timePeriodLengths = new Array("60","60","24","7","4.35","12");

//search: Wed, 27 May 2009 15:52:40 +0000
//user feed: Thu May 21 00:09:16 +0000 2009
function TB_str2date(dateString) {
	
	var dateObj = new Date(),
	dateData = dateString.split(/[\s\:]/);
	
	// if it's a search format
	if (dateString.indexOf(',') >= 0) {
		// $wday,$mday, $mon, $year, $hour,$min,$sec,$offset
		dateObj.setUTCFullYear(dateData[3],TB_monthNumber[""+dateData[2]]-1,dateData[1]);
		dateObj.setUTCHours(dateData[4],dateData[5],dateData[6],0);
	}
	// if it's a user feed format
	else {
		// $wday,$mon,$mday,$hour,$min,$sec,$offset,$year
		dateObj.setUTCFullYear(dateData[7],TB_monthNumber[""+dateData[1]]-1,dateData[2]);
		dateObj.setUTCHours(dateData[3],dateData[4],dateData[5],0);
	}

	return dateObj;
}

function TB_verbalTime(dateObj) {

 var j,
	now = new Date(),
	difference,
	verbalTime,
	template;
	
	if (now.getTime() > dateObj.getTime()) {
		difference = Math.round((now.getTime() - dateObj.getTime()) / 1000);
		template = TB_labels.time_past;
	}
	else {
		difference = Math.round((dateObj.getTime() - now.getTime()) / 1000);
		template = TB_labels.time_future;
	}
		

 for(j = 0; difference >= TB_timePeriodLengths[j] && j < TB_timePeriodLengths.length; j++) {
     difference = difference / TB_timePeriodLengths[j];
 }
 difference = Math.round(difference);

 verbalTime = TB_timePeriods[j];
 if (difference != 1) {
     verbalTime = TB_timePeriodsPlural[j];;
 }

 return template.format(difference,verbalTime);
}

function TB_addLoadEvent(func) { 
	var oldonload = window.onload; 
	if (typeof window.onload != 'function') { 
	    window.onload = func; 
	} else { 
	    window.onload = function() { 
	      oldonload(); 
	      func(); 
	    }
	} 
}

//function to get the size of an object
function TB_getObjectSize(obj) {
	var size = 0, key;
	for (key in obj) {
	     if (obj.hasOwnProperty(key)) size++;
	}
	return size;
}

//function to dedupe array
function TB_getUniqueElements(arr) {
	 var uniques = [], i, val;
	 for(i=arr.length;i--;){
	     val = arr[i];  
	     if(jQuery.inArray( val, uniques )===-1){
	         uniques.unshift(val);
	     }
	 }
	 return uniques;
}

//Add format function to enable templates
String.prototype.format = function() {
	var s = this, i = arguments.length;

	 while (i--) {
	     s = s.replace(new RegExp('\\{' + i + '\\}', 'gm'), arguments[i]);
	 }
	 return s;
};
