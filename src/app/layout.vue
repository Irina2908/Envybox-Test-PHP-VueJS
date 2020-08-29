<script>
import Feedback from "./pages/feedback";
export default {
    name: 'layout',
    components: {Feedback}
}
</script>

<template>
    <div class="container">
        <main class="main">
            <div class="main__content">
                <feedback></feedback>
            </div>
        </main>
        <footer class="footer"></footer>
    </div>
</template>

<style lang="scss">
    .footer {
        height: 200px;
    }
</style>