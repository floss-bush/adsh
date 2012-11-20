
var pagerTimeout;

function getTweets(screenName, destId, callback)
{
	jQuery.getJSON("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=" 
			  	+ screenName + "&count=5&include_rts=1&callback=?",
 		function(data) {
			
			jQuery("#" + destId).empty();
			
			jQuery.each(data, function(i,item) {
				ct = item.text;
				ct = ct.replace(/https?:\/\/\S+/g,  '<a href="$&" target="_blank">$&</a>');
			    ct = ct.replace(/(^|\s)(@)(\w+)/g,    ' <a href="http://twitter.com/$3" target="_blank">@$3</a>');
			    ct = ct.replace(/(^|\s)(#)(\w+)/g,    ' <a href="http://search.twitter.com/search?q=%23$3" target="_blank">#$3</a>');
				jQuery("#" + destId).append('<div id="' + destId + '-' + i + '">' + ct + "</div>");
 			});
			
			if (callback) callback();
			
		});
}

function setupPager(tweetsId, pagerListId)
{
	jQuery("#" + pagerListId).empty();
	
	jQuery("#" + tweetsId + " div").each(function(index) {
		jQuery("#" + pagerListId).append('<li><a href="javascript:selectTweet(' + "'" + jQuery(this).attr("id") + "'" + ', 16000)" id="p-' + jQuery(this).attr("id") + '"></a></li>');
	});
	
	id = jQuery('#' + tweetsId).children().first().attr("id");
	selectTweet(id, 6000);
}

function selectTweet(tweetId, timeout)
{
	clearTimeout(pagerTimeout);

	jQuery('#' + tweetId).parent().children().fadeOut();
	jQuery('#' + tweetId).parent().children().removeClass();
	jQuery('#p-' + tweetId).parent().parent().find('a').removeClass();
	jQuery('#' + tweetId).fadeIn();

	jQuery('#' + tweetId).addClass("active");
	jQuery('#p-' + tweetId).addClass("active");
	
	pagerTimeout = setTimeout( function() { selectTweet(getNextTweetId(jQuery('#' + tweetId).parent().attr('id')), 6000); }, timeout );
}

function getNextTweetId(tweetsId)
{
	next = jQuery('#' + tweetsId).find('.active').next();
	if (jQuery(next).size() < 1)
	{
		next = jQuery('#' + tweetsId).children().first();
	}
	return jQuery(next).attr("id");
}