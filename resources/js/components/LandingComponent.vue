<template>
  <v-app>
    <navbar id="nav"></navbar>
    <v-content>
      <hero></hero>

      <benefits></benefits>

      <about></about>

      <current-event></current-event>

      <gallery></gallery>

      <join-us></join-us>

      <v-parallax height="400" :src="full_src"></v-parallax>

      <contact></contact>

      <foot></foot>
    </v-content>
  </v-app>
</template>

<script>
import NavComponent from './landing/NavComponent.vue'
import HeroComponent from './landing/HeroComponent.vue'
import ContactComponent from './landing/ContactComponent.vue'
import FooterComponent from './landing/FooterComponent.vue'
import BenefitsComponent from './landing/BenefitsComponent.vue'
import AboutComponent from './landing/AboutComponent.vue'
import CurrentEventComponent from './landing/CurrentEventComponent.vue'
import GalleryComponent from './landing/GalleryComponent.vue'
import JoinUsComponent from './landing/JoinUsComponent.vue'

export default {
  components: { 
    'navbar' : NavComponent,
    'hero' : HeroComponent,
    'benefits' : BenefitsComponent,
    'about' : AboutComponent,
    'current-event' : CurrentEventComponent,
    'gallery' : GalleryComponent,
    'join-us' : JoinUsComponent,
    'contact' : ContactComponent,
    'foot' : FooterComponent
  },
  data(){
    return{
      full_src: 'resources/images/full.jpg',
    }
  },  
}
</script>