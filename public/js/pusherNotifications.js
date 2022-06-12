var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-bs-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
// var notifications = notificationsWrapper.find('li.scrollable-container');
var notifications = notificationsWrapper.find('ul.scrollable-container');


// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('new-notification');
// Bind a function to a Event (the full Laravel class)
channel.bind('pusher:subscription_succeeded', function (data) {
    var existingNotifications = notifications.html();
    var newNotificationHtml =
    '<li class="notification-item">'+
    '<i class="bi bi-exclamation-circle text-warning"></i>'+
    '<div>'+
      '<h4>assigned quiz to you</h4>'+
      '<p>the teacher' +data.name+' assigned quiz '+data.title+' to you click'+
    'here to redirect to the <a href="">quiz</a>'+  '</p>'+
      '<p></p>'+
    '</div>'+
  '</li>';
  notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});

