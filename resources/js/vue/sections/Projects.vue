<template>
    <section id="projects-section">
        <h1>My Projects</h1>
        <div>
            <router-view :projects="projects"><!-- props for only ProjectsCarousel --></router-view>
        </div>
        <div class="separator"></div>
        <div class="projects-slides">
            <router-link v-for="project of projects" :key="project.id" class="project-card"
                @click.native="redirect('#projects-section')" :to="{ name: 'project', params: { slug: project.slug } }"
                :style="{ backgroundImage: `url(/storage/${project.img_path})` }">
                <div class="proj-title">{{ project.title }}</div>
            </router-link>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Projects',
    mounted() {
        console.log('Projects mounted.')
    },
    props: {
        projects: Array
    },
    methods: {
        redirect(elementId) {
            const element = document.querySelector(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        },
    }
}

</script>

<style scoped lang="scss">
#projects-section {
    display: flex;
    flex-direction: column;
    padding: 4rem;
    gap: 4rem;
    justify-content: space-between;
    background-color: black;
    color: white;
    position: relative;

    .separator {
        margin: auto;
        border: 1.5px solid rgb(125, 125, 125);
        width: 90%;
    }

    .projects-slides {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;

        .project-card {
            display: inline-block;
            height: 100px;
            width: 200px;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            border: 3px white solid;
            border-radius: 15px;

            .proj-title {
                padding: .5rem;
                text-align: center;
                background-color: rgba($color: #000000, $alpha: .7);
                border-radius: 12px 12px 0 0;
                color: white;

            }
        }
    }
}

@media screen and (max-width: 400px) {
    #projects-section {
        gap: 1rem;
        padding: .5rem;
    }
}

@media screen and (min-width: 401px) and (max-width: 768px) {
    #projects-section {
        gap: 2rem;
        padding: 1rem;
    }
}
</style>
