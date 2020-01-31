jQuery(document).ready(function($) {

    // console.clear();

    var hash = window.location.hash,
        token = hash.substring(14),
        id = token.split('.')[0];

    // if ( hash !== '') {
    //     console.log( '%c' + hash, 'color: #008000c2');
    // } else {
    //     console.log( '%chash is not set!', 'color: #dc2121c7');
    // }

    $(document).on('click', '.td-add-account' , function(event) {
        var $this = $(this);

        if ( $this.hasClass('disabled') ){
            event.preventDefault();

            if ( $this.siblings( ".td-account-error" ).length < 1 ) {
                $this.after('<div class="td-account-error" style="color: orangered; font-size: 12px; font-style: italic;">You already have a connected account. To connect to another, please remove the current one.</div>');
            }

        }
    });

    $(document).on('click', '.td-remove-account' , function(event) {
        event.preventDefault();

        var $this = $(this);
        var account_id = $this.data('id');
        var account_username = $this.data('username');

        tdRemoveAccount(account_id,account_username);
    });

    $(document).on('click', '.td-insta-acc-token-trigg .td-check-wrap', function(event){

        var $this = jQuery(this);
        var token = jQuery('.td-insta-acc-token');

        $this.parents('.td-classic-check').hasClass('active');

        if ( $this.parents('.td-classic-check').hasClass('active') ) {
            $this.parents('.td-classic-check').removeClass('active');
            // we are deactivating
            token.hide();
        } else {
            // we are activating
            $this.parents('.td-classic-check').addClass('active');
            token.show();
        }

    });

    if ( token.length > 40 ) {

        jQuery.ajax({
            url: td_ajax_url,
            type: 'post',
            data: {
                action: 'td_after_connection',
                access_token: token,
            },
            success: function (data) {
                var reply = JSON.parse(data);

                if ( reply.status.includes('success') ) {
                    var accountData = reply.account_data;
                    accountData.token = token;
                    tdSaveAccount(token);

                    // console.log( '%c' + reply.status, 'color: #008000c2');
                    // console.group('after connection account data for saving');
                    // console.log(reply.account_data);
                    // console.groupEnd();

                } else {

                    if ( reply.status.includes('error') ) {
                        var message = reply.status;
                        $('#td-instagram-tk-error').show().append('<p>' + message + '</p>');
                        // console.log( '%c' + message, 'color: #dc2121c7');
                    }
                }

            },
            error: function (jqXHR,textStatus,errorThrown ) {
                // console.log( '%c' + errorThrown, 'color: #dc2121c7');
            }
        });

        window.location.hash = '';
    }

    function tdSaveAccount(token) {
        jQuery.ajax({
            url: td_ajax_url,
            type: 'post',
            data: {
                action: 'td_save_account',
                access_token: token
            },
            success: function (data) {
                var reply = JSON.parse(data);

                if ( reply.status.includes('success') ) {

                    // console.log( '%c' + reply.status, 'color: #008000c2');
                    // console.group('saved account data');
                    // console.log(reply.account_data);
                    // console.groupEnd();

                    tdAfterAccountUpdate(reply.account_data);

                }

                if ( reply.status.includes('error') ) {
                    // console.log( '%c' + reply.status, 'color: #dc2121c7');
                }

                if ( reply.status.includes('warning') ) {
                    // console.log( '%c' + reply.status, 'color: #f48024e8');
                }
                
            },
            error: function (jqXHR,textStatus,errorThrown ) {
                // console.log( '%c' + errorThrown, 'color: #dc2121c7');
            }
        });
    }

    function tdRemoveAccount(id,username) {
        jQuery.ajax({
            url: td_ajax_url,
            type: 'post',
            data: {
                action: 'td_remove_account',
                account_id: id,
                account_username: username
            },
            success: function (data) {
                var reply = JSON.parse(data);
                
                if ( reply.status.includes('success') ) {
                    // console.log( '%c' + reply.status, 'color: #008000c2');

                    $('.td-account-error').remove();
                    $('.td-add-account').removeClass('disabled').attr('title', 'Connect to your Instagram Account');
                    $('.td-box-control-inst-account').html('<p class="td-no-inst-account-message"><strong>No account connected!</strong></p>');
                    $('.td-box-control-inst-account-debug').hide();

                }

                if ( reply.status.includes('error') ) {
                    // console.log( '%c' + reply.status, 'color: #dc2121c7');
                }

                if ( reply.status.includes('warning') ) {
                    // console.log( '%c' + reply.status, 'color: #f48024e8');
                }

            },
            error: function (jqXHR,textStatus,errorThrown ) {
                // console.log( '%c' + errorThrown, 'color: #dc2121c7');
            }
        });
    }

    function tdAfterAccountUpdate(savedAccount) {
        $('.td-no-inst-account-message').hide();
        $('.td-add-account').addClass('disabled').attr('title', 'Your Instagram Account is already connected');
        $('.td-box-control-inst-account').append(
            '<div class="about-wrap">\n' +
                '            <div class="td-insta-acc-wrap">\n' +
                '                    <div class="td-insta-acc-photo"><img src="' + savedAccount.profile_picture + '" /></div>\n' +
                '                    <div class="td-insta-acc-user">' + savedAccount.username + '</div>\n' +
                '                    <div class="td-insta-acc-followers">' + savedAccount.followers + ' followers</div>\n' +
                '                    <div class="td-insta-acc-token-trigg">\n' +
                '                           <div class="td-classic-check">\n' +
                '                               <input type="checkbox" id="show_id_token" name="" value="">\n' +
                '                               <label for="show_id_token" class="td-check-wrap">\n' +
                '                                   <span class="td-check"></span>\n' +
                '                                   <span class="td-check-title">\n' +
                '                                       Show Access Token\n' +
                '                                   </span>\n' +
                '                               </label>\n' +
                '                           </div>\n' +
                '                    </div>\n' +
                '                    <div class="td-insta-acc-remove">\n' +
                '                       <a class="button button-secondary td-remove-account" ' +
                '                           href="#" ' +
                '                           data-id="' + savedAccount.user_id + '" ' +
                '                           data-username="' + savedAccount.username + '" ' +
                '                           >Remove</a>' +
                '                   </div>\n' +


                '                    <div class="td-insta-acc-token">\n' +
                '                           <div class="td-insta-acc-token-inner">\n' +
                '                               <div class="td-insta-acc-token-info">Access Token</div>\n' +
                '                                <div class="td-insta-acc-token-code">' + savedAccount.access_token + '</div>\n' +
                '                           </div>\n' +
                '                    </div>\n' +
                '            </div>\n' +

            '</div>'
        );
    }
});