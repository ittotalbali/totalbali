'use strict';

const ajaxRequest = {
    get: function ({
        url,
        data,
        successCallback = null,
        errorCallback = null
    }) {
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            data: data,
            dataType: 'json',
            async: true,
            success: successCallback,
            error: errorCallback
        });
    },
    
    post: function ({
        url,
        data,
        successCallback = null,
        errorCallback = null
    }) {
        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            async: true,
            success: successCallback,
            error: errorCallback
        });
    },
}