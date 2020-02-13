'use strict';

const endpoints = {
    get: 'api/feedback/get.php',
    create: 'api/feedback/create.php',
    update: 'api/feedback/update.php',
    delete: 'api/feedback/delete.php'
};

/**
 * Executes API request
 * @param {type} url Endpoint URL
 * @param {type} formData instance of FormData
 * @param {type} success Success callback
 * @param {type} fail Fail callback
 * @returns {undefined}
 */
function api(url, formData, success, fail) {
    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(obj => {
            if (obj.status === 'success') {
                success(obj.data);
            } else {
                fail(obj.errors);
            }
        })
        .catch(e => {
            console.log(e);
            fail(['Could not connect to API!']);
        });
}

/**
 * Form array
 * Contains all form-related functionality
 *
 * Object forms
 */
const forms = {
    /**
     * Create Form
     */
    create: {
        init: function () {
            console.log('Initializing create form...');
            if (this.getElement()) {
                this.getElement().addEventListener('submit', this.onSubmitListener);
            }

        },
        getElement: function () {
            return document.getElementById("create-form");
        },
        onSubmitListener: function (e) {
            e.preventDefault();
            let formData = new FormData(e.target);
            api(endpoints.create, formData, forms.create.success, forms.create.fail);
        },
        success: function (data) {
            const element = forms.create.getElement();

            card.row.append(data);
            forms.ui.errors.hide(element);
            forms.ui.clear(element);
            forms.ui.flash.class(element, 'success');
        },
        fail: function (errors) {
            forms.ui.errors.show(forms.create.getElement(), errors);
        }
    },
    /**
     * Update Form
     */
    update: {
        init: function () {
            console.log('Initializing update form...');
            this.elements.form().addEventListener('submit', this.onSubmitListener);

            const closeBtn = forms.update.elements.modal().querySelector('.close');
            closeBtn.addEventListener('click', forms.update.onCloseListener);

        },
        elements: {
            form: function () {
                return document.getElementById("update-form");
            },
            modal: function () {
                return document.getElementById("update-modal");
            }
        },
        onSubmitListener: function (e) {
            e.preventDefault();
            let formData = new FormData(e.target);
            let id = forms.update.elements.form().getAttribute('data-id');
            formData.append('id', id);

            api(endpoints.update, formData, forms.update.success, forms.update.fail);
        },
        success: function (data) {
            card.row.update(data);
            forms.update.hide();
        },
        fail: function (errors) {
            forms.ui.errors.show(this.elements.form(), errors);
        },
        fill: function (data) {
            forms.ui.fill(forms.update.elements.form(), data);
        },
        onCloseListener: function (e) {
            forms.update.hide();
        },
        show: function () {
            this.elements.modal().style.display = 'block';
        },
        hide: function () {
            this.elements.modal().style.display = 'none';
        }
    },
    /**
     * Common/Universal Form UI Functions
     */
    ui: {
        init: function () {
            // Function has to exist
            // since we're calling init() for
            // all elements withing forms object
        },
        /**
         * Fills form fields with data
         * Each data index corelates with input name attribute
         *
         * @param {Element} form
         * @param {Object} data
         */
        fill: function (form, data) {
            form.setAttribute('data-id', data.id);

            Object.keys(data).forEach(data_id => {
                if (form[data_id]) {
                    const input = form.querySelector('input[name="' + data_id + '"]');
                    if (input) {
                        input.value = data[data_id];
                    }
                }
            });
        },
        clear: function (form) {
            var fields = form.querySelectorAll('[name]')
            fields.forEach(field => {
                field.value = '';
            });
        },
        flash: {
            class: function (element, class_name) {
                const prev = element.className;

                element.className += class_name;
                setTimeout(function () {
                    element.className = prev;
                }, 1000);
            }
        },
        /**
         * Form-error related functionality
         */
        errors: {
            /**
             * Shows errors in form
             * Each error index correlates with input name attribute
             *
             * @param {Element} form
             * @param {Object} errors
             */
            show: function (form, errors) {
                this.hide(form);
                Object.keys(errors).forEach(function (error_id) {
                    const field = form.querySelector('input[name="' + error_id + '"]');
                    const span = document.createElement("span");
                    span.className = 'field-error';
                    span.innerHTML = errors[error_id];
                    field.parentNode.append(span);

                    console.log('Form error in field: ' + error_id + ':' + errors[error_id]);
                });
            },
            /**
             * Hides (destroys) all errors in form
             * @param {type} form
             */
            hide: function (form) {
                const errors = form.querySelectorAll('.field-error');
                if (errors) {
                    errors.forEach(node => {
                        node.remove();
                    });
                }
            }
        }
    }
};

/**
 * card-related functionality
 */
const table = {
    getElement: function () {
        return document.querySelector('#reviews-table tbody');
    },
    init: function () {
        this.data.load();

        Object.keys(this.buttons).forEach(buttonId => {
            table.buttons[buttonId].init();
        });
    },
    /**
     * Data-Related functionality
     */
    data: {
        /**
         * Loads data and populates table from API
         * @returns {undefined}
         */
        load: function () {
            api(endpoints.get, null, this.success, this.fail);
        },
        success: function (data) {
            Object.keys(data).forEach(i => {
                table.row.append(data[i]);
            });
        },
        fail: function (errors) {
            console.log(errors);
        }
    },
    /**
     * Operations with rows
     */
    row: {
        /**
         * Builds row element from data
         *
         * @param {Object} data
         * @returns {Element}
         */
        build: function (data) {
            const row = document.createElement('tr');
            row.setAttribute('data-id', data.id);

            Object.keys(data).forEach(data_id => {
                let td = document.createElement('td');
                td.className = data_id;
                td.innerHTML = data[data_id];

                if (data_id !== 'id' && data_id !== 'user_id') {
                    row.append(td);
                }
            });

            return row;
        },
        /**
         * Appends row to table from data
         *
         * @param {Object} data
         */
        append: function (data) {
            table.getElement().append(this.build(data));
        },
        /**
         * Updates existing row in table from data
         * Row is selected via "id" index in data
         *
         * @param {Object} data
         */
        update: function (data) {
            let row = table.getElement().querySelector('tr[data-id="' + data.id + '"]');
            row.replaceWith(this.build(data));
            //row = this.build(data);
        },
        /**
         * Deletes existing row
         * @param {Integer} id
         */
        delete: function (id) {
            const row = table.getElement().querySelector('tr[data-id="' + id + '"]');
            row.remove();
        }
    }
};
/**
 * Core page functionality
 */
const app = {
    init: function () {
        // Initialize all forms
        Object.keys(forms).forEach(formId => {
            forms[formId].init();
        });

        table.init();
    }
};

// Launch App
app.init();