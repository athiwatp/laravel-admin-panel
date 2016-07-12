/**
 * Created by Navdeep on 14-06-2016.
 */

var vm = new Vue({

    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el: '#vue-container',

    data: {
        checkedMenus: {},
        checkedMenus1: [],
        checkedMenus2: []
    },

    methods: {
        saveFormDetails: function () {
            //var checked = $('input.checkedMenus:checked');
            this.checkedMenus = { '1' : this.checkedMenus1, '2' : this.checkedMenus2 } ;
            this.$http.post('api/roles/', this.checkedMenus, function (data) {
                //this.postFormSubmission(data);
            });
        }
    },

    ready: function () {
        //this.checkedMenus = [];
    }

});