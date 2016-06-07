/**
 * Created by Navdeep on 01-03-2016.
 */

// register modal component
Vue.component('modal', {
    template: '#modal-template',
    props: {
        show: {
            type: Boolean,
            required: true,
            twoWay: true
        }
    }
})
var vm = new Vue({

    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el: '#vue-container',

    data: {
        newRecord: {
            id: '',
            name: '',
            email: '',
            crud_level: ''
        },

        success: false,

        edit: false,

        showForm : false,

        showModal: false
    },

    methods: {
        setShowForm: function(event){
            this.showForm = true;
            this.edit = false;
            this.newRecord.id = '';
            this.newRecord.name = '';
            this.newRecord.email = '';
            this.newRecord.crud_level = '';
        },

        getRecords: function () {
            this.$http.get('api/administrator', function (data) {
                this.$set('users', data)
            })
        },


        ShowRecord: function (id) {
            this.showForm = true;
            this.edit = true;

            this.$http.get('/api/v1/records/' + id, function (data) {
                this.newRecord.id = data.id;
                this.newRecord.name = data.name;
                this.newRecord.email = data.email;
                this.newRecord.crud_level = data.crud_level
            })
        },

        AddNewRecord: function () {
            this.$set('form.title', 'Add User');

            // Clear form input
            var user = {name: '', email: ''}
            this.$set('user', user);


            // Send post request
            //this.$http.post('/api/v1/records/', record);

            // Reload page
            this.getRecords();
        },

        EditRecord: function (id) {
            this.$set('form.title', 'Edit User');
            this.$http.get('api/administrator/'+id+'/edit', function (data) {
                this.$set('user', data);
                console.log(data);
            })
        },

        RemoveRecord: function (id) {
            var ConfirmBox = confirm("Are you sure, you want to delete this Record?");

            if (ConfirmBox) this.$http.delete('/api/v1/records/' + id);

            this.getRecords();
        }
    },

    computed: {
        validation: function () {
            return {
                name: !!this.newRecord.name.trim(),
                email: emailRE.test(this.newRecord.email),
                crud_level: !!this.newRecord.crud_level
            }
        },

        isValid: function () {
            var validation = this.validation
            return Object.keys(validation).every(function (key) {
                return validation[key]
            })
        }
    },

    ready: function () {
        this.getRecords()
    }

});