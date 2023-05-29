<template>
    <section>
        <div class="carousel carousel-dark slide">
            <div class="carousel-inner">
                <!-- PROJECT -->
                <div v-for="(project, i) of projects" :key="i" class="carousel-item" :class="(i == slide) ? 'active' : ''">
                    <img :src="'/storage/' + project.img_path" class="d-block my-img-fluid" :alt="project.title">
                    <div class="carousel-caption">
                        <h5>{{ project.title }}</h5>
                        <p class="d-none d-md-block">{{ getShortText(project.description) }}</p>

                        <router-link :to="{ name: 'project', params: { slug: project.slug } }" class="btn btn-info">vedi
                            project</router-link>
                    </div>
                </div>
            </div>
            <!-- BTN CONTROLLER -->
            <button class="carousel-control-prev" @click="prevSlide()">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" data-slide="next" @click="nextSlide()">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'ProjectsCarousel',
    data() {
        return {
            slide: 0,
            intervalId: null,
            intervalTime: 7500
        }
    },
    methods: {
        prevSlide() {
            if (this.slide == 0)
                this.slide = this.projects.length - 1
            else
                this.slide--
            this.resetAutoplay()
        },
        nextSlide() {
            if (this.slide == this.projects.length - 1)
                this.slide = 0
            else
                this.slide++
            this.resetAutoplay()
        },
        startAutoplay() {
            this.intervalId = setInterval(() => {
                this.nextSlide()
            }, this.intervalTime)
        },
        resetAutoplay() {
            clearInterval(this.intervalId)
            this.startAutoplay()
        },
        getShortText(string) {
            let newString = "";
            for (let index = 0; index <= 70; index++) {
                newString += string.charAt(index);
            }
            console.log(newString);
            return newString
        },
    },
    mounted() {
        console.log('Carousel mounted.')
        this.startAutoplay()
    },

    props: {
        projects: Array
    }

}

</script>

<style scoped lang="scss">
.carousel.slide {
    width: 75vw;
    height: 30vw;
    margin: auto;

    div {
        height: 100%;

        div {
            height: 100%;

        }
    }

}

p,
h5,
button {
    background-color: rgba(0, 0, 0, .5);
}

.my-img-fluid {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
