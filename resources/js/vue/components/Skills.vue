<template>
    <div id="skills-section">

        <h1>Skills</h1>
        <div v-if="skills">
            <div v-for="skill in skills" :key="skill.id">{{ skill.name }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Skills',

    // components: {}
    props: {
        skills: Array
    }
}

</script>

<style scoped lang="scss"></style>
