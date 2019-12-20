<template>
  <div>
    <!-- <ul>
      <li
        v-for="item in collection"
        :key="item"
      >
        {{ item }}
      </li>
    </ul>
    <hr> -->
    <div>
      <a
        v-for="p in pagination.pages"
        :key="p"
        @click.prevent="setPage(p)"
      >
        {{ p }}
      </a>
    </div>
    display from {{ pagination.startIndex + 1 }} to {{ pagination.endIndex + 1 }}
  </div>
</template>

<script>
export default {
  name: 'APagination',

  data: () => ({
    data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
    perPage: 4,
    pagination: {},
  }),

  created() {
    this.setPage(1);
  },

  computed: {
    collection() {
      return this.paginate(this.data);
    },
  },

  methods: {
    setPage(p) {
      this.pagination = this.paginator(this.data.length, p);
    },

    paginate(data) {
      return _.slice(data, this.pagination.startIndex, this.pagination.endIndex + 1);
    },

    paginator(totalItems, currentPage) {
      const startIndex = (currentPage - 1) * this.perPage;
      const endIndex = Math.min(startIndex + this.perPage - 1, totalItems - 1);

      return {
        currentPage,
        startIndex,
        endIndex,
        pages: _.range(1, Math.ceil(totalItems / this.perPage) + 1),
      };
    },
  },
};
</script>
