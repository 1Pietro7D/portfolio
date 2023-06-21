<template>
    <div class="p-5" v-if="true">
        <carousel-3d :perspective="30" :border="this.border3d" :width="this.width3d" :height="this.height3d"
            :controls-visible="true" :space="this.space3d" :clickable="true">
            <slide v-for="(slide, i) in projects" :index="i" :key="i">
                <template slot-scope="{ index, isCurrent, leftIndex, rightIndex }">
                    <router-link v-if="isCurrent" :to="{ name: 'project', params: { slug: slide.slug } }">
                        <img :data-index="index" class="my-img-fluid"
                            :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }"
                            :src="'/storage/' + slide.img_path">

                    </router-link>
                    <img v-else :data-index="index" class="my-img-fluid"
                        :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }"
                        :src="'/storage/' + slide.img_path">
                </template>
            </slide>

        </carousel-3d>
    </div>
</template>

<script>
export default {
    name: 'Carousel3D',
    data() {
        return {
            slideWidth: 40, // %
            width3d: 0, // px
            slideHeight: 30, // %
            height3d: 0, // px
            slideSpace: 20, // %
            space3d: 0, // px
            border3d: 3

        }
    },
    mounted() {
        window.addEventListener('resize', this.resizer3d);
        this.resizer3d();
    },
    destroyed() {
        console.log("rimuovo evento resize da componente");
        window.removeEventListener('resize', this.resizer3d);
    },
    methods: {
        resizer3d() {
            // Extra Small (XS): Fino a 576px
            // Small (SM): Da 577px a 768px
            // Medium (MD): Da 769px a 992px
            // Large (LG): Da 993px a 1200px
            // Extra Large (XL): Da 1201px a 1440px
            // Extra Extra Large (XXL): Da 1441px a 1680px

            const carousel3d = document.querySelector('.carousel-3d-container');
            const carousel3dWidth = carousel3d.offsetWidth;

            this.width3d = ((this.slideWidth / 100) * carousel3dWidth);
            this.height3d = ((this.slideHeight / 100) * carousel3dWidth);
            this.space3d = ((this.slideSpace / 100) * carousel3dWidth);

            // if (carousel3dWidth <= 576) {
            //     this.width3d = 200;
            //     this.height3d = 150;
            //     this.space3d = 100;
            // } else if (carousel3dWidth > 576 && carousel3dWidth <= 768) {
            //     this.width3d = 300;
            //     this.height3d = 200;
            //     this.space3d = 150
            // } else if (carousel3dWidth >= 769 && carousel3dWidth <= 992) {
            //     this.width3d = 400;
            //     this.height3d = 250;
            //     this.space3d = 200
            // } else if (carousel3dWidth >= 993 && carousel3dWidth <= 1200) {
            //     this.width3d = 500;
            //     this.height3d = 300;
            //     this.space3d = 250
            // } else if (carousel3dWidth > 1200) {
            //     this.width3d = 600;
            //     this.height3d = 350;
            //     this.space3d = 300
            // }
        }
    },


    props: {
        projects: Array
    }

}

</script>

<style scoped lang="scss">
p,
h5,
button {
    background-color: rgba(0, 0, 0, .5);
}

.carousel-3d-controls {
    a {
        color: white;
    }
}
</style>

