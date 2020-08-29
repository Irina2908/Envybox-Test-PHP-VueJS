<script>
export default {
    name: "feedback-form"
}
</script>

<template>
    <form class="form" name="feedbackForm" method="post" action="">
        <div class="form__container">
            <div class="form__content">
                <div class="form__field">
                    <span class="form__field-name">Имя:</span>
                    <input class="form__field-input" type="text"/>
                </div>
                <div class="form__field">
                    <span class="form__field-name">Телефон:</span>
                    <input class="form__field-input" type="text"/>
                </div>
                <div class="form__field">
                    <span class="form__field-name">Сообщение:</span>
                    <textarea class="form__field-input form__field-input_textarea form__field-input_resize_y"></textarea>
                </div>
            </div>
        </div>
    </form>
</template>