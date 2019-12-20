<template>
  <div id='google-map' />
</template>

<script>
export default {
  name: 'AMap',

  props: {
    mapData: {
      type: Array,
      default: () => [],
    },

    isMarkerCluster: {
      type: Number,
      default: 1,
    },
  },

  data: () => ({
    markers: [],
  }),

  watch: {
    mapData() {
      this.getFormattedMapData();
      this.initMap();
    },
  },

  methods: {
    getFormattedMapData() {
      this.markers = this.mapData.map((item) => ({
        id: item.id,
        company: item.company,
        label: item.lrds,
        contact: item.contact,
        phone: item.phone,
        geocode_accuracy: item.geocode_accuracy,
        lat: Number(item.latitude),
        lng: Number(item.longitude),
      }));
    },

    initMap() {
      const map = new google.maps.Map(document.getElementById('google-map'), {
        center: { lat: 35.188091, lng: -81.1 },
        scrollwheel: true,
        zoom: 8,
      });

      const infoWin = new google.maps.InfoWindow();

      this.markers = this.markers.map((point) => {
        const contentString = this.getContentString(point);

        const marker = new google.maps.Marker({
          title: `id: ${point.id}, company: ${point.company}`,
          position: { lat: point.lat, lng: point.lng },
          map,
          id: point.id,
        });

        google.maps.event.addListener(marker, 'click', () => {
          infoWin.setContent(contentString);
          infoWin.open(map, marker);
        });

        return marker;
      });

      if (this.isMarkerCluster) {
        new MarkerClusterer(map, this.markers, { imagePath: 'http://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m' });
      }
    },

    getContentString(point) {
      return [
        this.windowContentTitle(point),
        // this.windowContentTabs(),
        this.windowContentContactTab(point),
        // this.windowContentDeliveryTab(),
      ].join('');
    },

    windowContentTitle(point) {
      return `
        <h2 class="info-window__company">${point.company}</h2>
        <h3>${point.label}&nbsp;&nbsp;&nbsp;Nov 20, 2019</h3>
      `;
    },

    windowContentTabs() {
      return `
        <div class="info-window__tabs">
          <div>Conpact</div>
          <div style="display: none;">Delivery</div>
        </div>
      `;
    },

    windowContentContactTab(point) {
      return `
        <div class="info-window__content">
          <div class="info-window__content-row">
            <div class="info-window__left-col">id:</div>
            <div class="info-window__right-col">${point.id}</div>
          </div>
          <div class="info-window__content-row">
            <div class="info-window__left-col">contact:</div>
            <div class="info-window__right-col">${point.contact}</div>
          </div>
          <div class="info-window__content-row">
            <div class="info-window__left-col">phone:</div>
            <div class="info-window__right-col">${point.phone}</div>
          </div>
          <div class="info-window__content-row">
            <div class="info-window__left-col">accuracy:</div>
            <div class="info-window__right-col">${point.geocode_accuracy}</div>
          </div>
        </div>
      `;
    },

    windowContentDeliveryTab() {
      return `
        <div class="info-window__content">
          DeliveryContent
        </div>
      `;
    },
  },
};
</script>

<style lang='scss'>
#google-map {
  flex: 1;
}
.info-window {
  &__tabs {
    display: flex;
  }
  &__content-row {
    display: flex;
    margin-bottom: 10px;
  }
  &__left-col {
    width: 40%;
    padding-right: 5px;
    text-align: right;
  }
  &__right-col {
    width: 60%;
  }
}
</style>
