function scrollToBottom() {
    $('.main_chat_inox').scrollTop($('.main_chat_inox').prop("scrollHeight"));
}

window.Echo.private('message.' + USER.id).listen(
    "Message",
    (e) => {

        let userId = $('.main_chat_inox').attr('data-inbox-user');
        let listingId = $('.main_chat_inox').attr('data-inbox-listing');

        if (userId == e.user.id && listingId == e.listing_id) {
            var message = `
            <div class="tf__chating">
                <div class="tf__chating_img">
                    <img src="${e.user.avatar}" alt="user_avatar"
                        class="img-fluid w-100 rounded-circle">
                </div>
                <div class="tf__chating_text">
                    <p>${e.message_data} </p>
                </div>
            </div>`;

            mainChatInbox.append(message);
            scrollToBottom();
        }

        $('.profile-card').each(function () {
            let profileUserId = $(this).data('receiver-id');
            let profileListingId = $(this).data('listing-id');

            if (profileUserId == e.user.id && profileListingId == e.listing_id) {
                $(this).find('.profile_img').addClass('new_message');
            }

        });

    }
)

window.Echo.join('online')
    .here((users) => {
        $.each(users, function (index, user) {
            $('.profile-card').each(function () {
                let profileUserId = $(this).data('receiver-id');

                if (profileUserId == user.id) {
                    $(this).find('.user-status').addClass('user-active');
                }

            });
        });

    })
    .joining((user) => {
        $(`.profile-card[data-receiver-id="${user.id}"]`).find('.user-status').addClass('user-active');
    })
    .leaving((user) => {
        $(`.profile-card[data-receiver-id="${user.id}"]`).find('.user-status').removeClass('user-active');
    })
