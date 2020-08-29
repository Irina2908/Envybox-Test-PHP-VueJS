<script>
import FeedbackForm from "./feedback/feedback-form";

export default {
    name: "feedback",
    components: { FeedbackForm }
}
</script>

<template>
    <div class="page feedback">
        <div class="page__header">
            <h1 class="page__title">Обратная связь</h1>
        </div>

        <div class="page__content page__content_feedback feedback__content">
            <feedback-form class="feedback__form"></feedback-form>
        </div>
    </div>
</template>