<template>
    <section id="skills-section">
        <div v-if="skills">
            <h1>Skills</h1>
            <div v-for="skill in skills" :key="skill.id">
                <i class="skill-icon" :class="skill.icon_path"></i>
                {{ skill.name }}
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Skills',

    mounted() {
        console.log('Skill mounted.')
    },

    props: {
        skills: Array
    }
}

</script>

<style scoped lang="scss">
#skills-section {
    height: 1000px;
    background-color: aqua;
}
</style>
