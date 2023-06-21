<template>
    <section>
        <div v-if="loading" class="loading">
            <img :src="loadGif('/images/loading.gif')" alt="loading" class="my-img-fluid" />
            <!-- <img src="../../../../public/assets/loading.gif" alt="loading" class="my-img-fluid" /> -->
        </div>
        <div v-else-if="project" class="project-container">
            <router-link :to="{ name: 'home' }" class="absolute-top-right"><i class="fa-solid fa-house"></i></router-link>
            <div class="flex-container">

                <div class="project-details">
                    <h2>{{ project.title }}</h2>
                    <p>{{ project.description }}</p>
                    <div v-if="project.link_github">
                        <a :href="project.link_github">Vedi Github</a>
                    </div>
                </div>

                <div class="media-container">
                    <div v-if="project.img_path" class="project-img">
                        <img :src="'/storage/' + project.img_path" :alt="project.description" class="my-img-fluid">
                    </div>
                    <div v-if="project.video_path">
                        <video controls class="project-video">
                            <source :src="'/storage/' + project.video_path" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>

            </div>

        </div>
        <div v-else>Error</div>
    </section>
</template>

<script>
export default {
    name: 'ProjectDetail',
    data() {
        return {
            loading: true,
            project: null,
        }
    },
    mounted() {
        console.log('Project mounted.')
        this.loadPage('api/portfolio/' + this.$route.params.slug);
    },
    watch: {
        '$route': function (to, from) {
            // il codice qui verrà eseguito quando l'URL cambia
            //console.log('URL1 changed');
            //console.log(from);
            //console.log(this.$route.params.slug);
            //console.log(to.params.slug);
            const newSlug = to.params.slug
            this.loadPage('api/portfolio/' + newSlug);
        }
    },
    // approfondire require(***)
    methods: {
        loadGif(path) {
            // Why? because the gif is incorrect on reboot, with timestamp or unique value, it reboots fine
            const timestamp = Date.now();
            return path + "?" + timestamp;
        },
        reset() {
            this.project = null;
            this.loading = true;
        },
        loadPage(url) {
            axios.get(url)
                .then(({ data }) => {
                    if (data.success) {

                        //console.log("siamo dentro il load success");
                        this.project = data.result;
                        // Esempio 1: Visualizza un messaggio dopo 1,5 secondi
                        setTimeout(() => {
                            console.log("Timeout scaduto dopo 1,5 secondo.");
                            this.loading = false;
                        }, 1300);

                    } else {
                        this.$route.push({ name: 'NotFound' });
                    }

                })
                .catch(e => {
                    console.log('errore', e);
                    this.loading = false;
                })
        }
    },
    beforeRouteUpdate(to, from, next) {
        // il codice qui verrà eseguito prima che URL cambi
        this.reset();
        console.log('URL beforeRouteUpdate changed');
        next();
    },
    beforeDestroy() {
        // il codice qui verrà eseguito immediatamente prima che il componente venga distrutto
        this.reset();
        console.log('Component before Destroy');
    },
    destroyed() {
        // il codice qui verrà eseguito dopo che il componente è stato distrutto
        console.log('Component has been destroyed');
    },
}

</script>

<style scoped lang="scss">
.loading {
    margin: auto;
    width: 50%;
}

.project-container {

    .flex-container {
        padding: 2rem 4rem;
        display: flex;
        flex-wrap: wrap-reverse;
        justify-content: space-between;
        gap: 2rem;

        .media-container,
        .project-details {
            width: calc(50% - 1rem);
        }

        @media screen and (max-width: 800px) {

            .media-container,
            .project-details {
                width: 100%;

            }
        }

        .media-container div {
            border: 3px solid #767bb3;
            border-radius: 6px;
        }
    }
}

.absolute-top-right {
    position: absolute;
    top: 10rem;
    left: 8rem;
    color: white;
    text-decoration: none;
    font-size: 2rem;
}

.project-img {
    width: 100%;
    margin-bottom: 2rem;
}

.project-video {
    width: 100%;
}
</style>
