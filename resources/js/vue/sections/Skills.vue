<template>
    <section id="skills-section" class="my-flex-section">
        <h1>My Skills</h1>
        <div translate="no">
            <h3>FrontEnd</h3>
            <div class="skills-container">
                <div v-for="(skill, i) in skills" :key="i" :class="i < 6 ? 'skill-card' : 'd-none'">

                    <i class="skill-icon" :class="skill.icon_path"></i>
                    <span>{{ skill.name }} </span>

                </div>
            </div>
            <h3>BackEnd</h3>
            <div class="skills-container">
                <div v-for="(skill, i) in skills" :key="i" :class="i >= 6 ? 'skill-card' : 'd-none'">

                    <i class="skill-icon" :class="skill.icon_path"></i>
                    <span>{{ skill.name }} </span>

                </div>
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
    data() {
        return {
            i: -1
        }
    },
    props: {
        skills: Array
    }
}

</script>

<style scoped lang="scss">
#skills-section {
    background-color: #767bb3;

    .skills-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;

        .skill-card {
            padding: .75rem 1.5rem;
            border: 2px red solid;
            border-radius: 10rem;
            box-shadow: 0 0 14px rgba(155, 0, 0, 0.5);
            font-weight: bold;
            color: white;
            background-color: #000537;
            display: flex;
            gap: .5rem;
            align-items: center;

            .skill-icon {
                font-size: 24px;
            }
        }
    }
}
</style>
