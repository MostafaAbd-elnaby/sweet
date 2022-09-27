<template>
  <q-page>
    <banner-slider />
    <Categorise @childCat="childCat" title="Categories" />
    <Categorise v-if="showCatChild" @childCat="childCat" :catChild="catChildrenis" :title="catChildrenis.name_en" />
    <home-products />
    <collection :title="$t('index.title')" />
    <services class="q-mt-xl" />
  </q-page>
</template>

<script>
import BannerSlider from "src/components/Banner/BannerSlider.vue";
import Collection from "components/Collection/Collection.vue";
import HomeProducts from "components/HomeProducts/HomeProducts.vue";
import Services from "src/components/Services/Services.vue";
import Categorise from "components/Categorise/Categorise";
export default {
  components: { BannerSlider, Collection, HomeProducts, Services, Categorise },
  name: "PageIndex",
  data() {
    return {
      showCatChild: false,
      catChildrenis: null,
    };
  },
  methods : {
    childCat(cat) {
      this.showCatChild = true
      this.catChildrenis = cat
    }
  },
  created() {
    // setInterval(function () {
      Notification.requestPermission().then(function(result) {
        console.log(result);
      });

      var img = 'http://sweet-api.alfatechegy.com/storage/product/xPmTOeIkgnzBNzdaRQG3wLAz6ODFohXBniFjdqWP.png';
      var text = 'Ahmed Salah be masy';
      var notification = new Notification('Abo abd el salam', { body: text, icon: img });
    // }, 2000);


    // If the user agreed to get notified
    // Let's try to send ten notifications
    // if (window.Notification && Notification.permission === "granted") {
    //   var i = 0;
    //   // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
    //   var interval = window.setInterval(function () {
    //     // Thanks to the tag, we should only see the "Hi! 9" notification
    //     var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
    //     if (i++ == 9) {
    //       window.clearInterval(interval);
    //     }
    //   }, 200);
    // }

      // If the user hasn't told if they want to be notified or not
      // Note: because of Chrome, we are not sure the permission property
    // // is set, therefore it's unsafe to check for the "default" value.
    // else if (window.Notification && Notification.permission !== "denied") {
    //   Notification.requestPermission(function (status) {
    //     // If the user said okay
    //     if (status === "granted") {
    //       var i = 0;
    //       // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
    //       var interval = window.setInterval(function () {
    //         // Thanks to the tag, we should only see the "Hi! 9" notification
    //         var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
    //         if (i++ == 9) {
    //           window.clearInterval(interval);
    //         }
    //       }, 200);
    //     }

        // Otherwise, we can fallback to a regular modal alert
        // else {
        //   alert("Hi!");
        // }
    //   });
    // }
    //
    // // If the user refuses to get notified
    // else {
    //   // We can fallback to a regular modal alert
    //   alert("Hi!");
    // }

  }
};
</script>

<style lang="scss" scoped >

</style>
