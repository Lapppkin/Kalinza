'use strict';

// Добавить в избранное

var favourites = {
    addedText: 'Добавить в избранное',
    removeText: 'Удалить из избранного',
    items: [],
    headerFavoritesDiv: $('.header--topbar--favorites'),
    headerFavoritesCounterSpan: $('.header--topbar--favorites-counter'),

    init: function () {
        this.eventHandler();
        this.loadOfCookie();
    },

    eventHandler: function () {
        var self = this;
        $(document).on('click', '.js-toggle-favorite', function () {
            var id = $(this).data('favorite-id');
            self.addOrRemove(String(id));
        });

        $(document).on('click', '.js-clear-all-favorite', function () {
            self.clearAll();
            return false;
        });
    },

    clearAll: function() {
        this.items = [];
        this.updateCookieFavourites();
        location.reload();
    },

    addOrRemove: function (id) {
        var isInIntems = this.items.indexOf(id) !== -1;
        if (isInIntems) {
            this.items.splice(this.items.indexOf(id), 1);
            this.renderAddedBtn(id);
        } else {
            this.items.push(id);
            this.renderRemoveBtn(id);
        }
        this.updateCookieFavourites();
    },

    renderAllBtnInit: function () {
        var self = this;
        if (this.items.length > 0) {
            $.each(this.items, function (i, id) {
                self.renderRemoveBtn(id);
            })
        }
    },

    renderAddedBtn: function (id) {
        $('[data-favorite-id="' + id + '"]').find('.kalinza-icon').css('color', '#ccc').closest('.js-toggle-favorite').attr('title', this.addedText);
        this.renderHeaderCounter();
    },

    renderRemoveBtn: function (id) {
        $('[data-favorite-id="' + id + '"]').find('.kalinza-icon').css('color', '#eb5757').closest('.js-toggle-favorite').attr('title', this.removeText);
        this.renderHeaderCounter();
    },

    loadOfCookie: function () {
        var cookieItems = this.getCookieFavourites('BX_FAVOURITES');
        this.items = cookieItems ? cookieItems.split(".") : [];
        this.renderAllBtnInit();
    },

    setCookieFavourites: function (name, value, expires, path, domain, secure) {
        var today = new Date(),
            expires_default = new Date();
        expires_default.setDate(today.getDate() + 999999);
        expires = expires ? expires : expires_default;
        document.cookie = name + "=" + encodeURI(value) + (expires ? "; expires=" + expires : "") + "; path=/" + (domain ? "; domain=" + domain : "") + (secure ? "; secure" : "");
    },

    getCookieFavourites: function (name) {
        var b = "; " + document.cookie;
        var c = b.split("; " + name + "=");
        return !!(c.length - 1)
            ? c.
            pop().
            split(";").
            shift()
            : false;
    },

    updateCookieFavourites: function () {
        if (this.items.length > 0) {
            this.setCookieFavourites('BX_FAVOURITES', this.items.join('.'))
        } else {
            this.setCookieFavourites('BX_FAVOURITES', '')
        }
    },

    renderHeaderCounter: function () {
        if (this.items.length > 0) {
            this.headerFavoritesCounterSpan.text(this.items.length);
            this.headerFavoritesDiv.addClass('active');
        } else {
            this.headerFavoritesCounterSpan.text(0);
            this.headerFavoritesDiv.removeClass('active');
        }
    }
};

favourites.init();
