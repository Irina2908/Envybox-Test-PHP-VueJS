<script>
import { mapGetters, mapActions } from 'vuex';

import MaskedInput from 'vue-masked-input';

export default {
    name: "feedback-form",
    components: { MaskedInput },
    computed: {
        ...mapGetters([
            'getField',
            'getFields'
        ]),
        name: {
            get() {
                return this.getField('name');
            },
            set(value) {
                this.setField({
                    name: 'name',
                    value: value,
                });
            },
        },
        phone: {
            get() {
                return this.getField('phone');
            },
            set(value) {
                let res = value.match(/^(\+7)?\s?\(?(\d{3})\)?\s?(\d{3})\-?(\d{2})\-?(\d{2})$/);

                if (res) {
                    res = res.slice(2);
                    value = res.join('');

                    this.setField({
                        name: 'phone',
                        value: value,
                    });
                }
            }
        },
        message: {
            get() {
                return this.getField('message');
            },
            set(value) {
                this.setField({
                    name: 'message',
                    value: value,
                });
            },
        }
    },
    methods: {
        ...mapActions([
            'setField',
        ]),
        send(e) {
            e.preventDefault();
        }
    }
}
</script>

<template>
    <form class="form" @submit="send" name="feedbackForm" method="post" action="">
        <div class="form__container">
            <div class="form__content">
                <div class="form__field">
                    <span class="form__field-name">Имя:</span>
                    <input class="form__field-input" type="text" v-model="name" />
                </div>
                <div class="form__field">
                    <span class="form__field-name">Телефон:</span>
                    <masked-input class="form__field-input" 
                                  v-model="phone" 
                                  mask="\+\7 (111) 111-11-11" 
                                  type="text" 
                                  placeholder="+7 (___) ___-__-__" />
                </div>
                <div class="form__field">
                    <span class="form__field-name">Сообщение:</span>
                    <textarea class="form__field-input form__field-input_textarea form__field-input_resize_y" v-model="message"></textarea>
                </div>
                <div class="form__bottom">
                    <div class="form__bottom-center">
                        <button class="form__submit-btn" type="submit">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>