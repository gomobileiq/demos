import moment from 'moment';

const timeFormats = {
  day: 'D',
  month: 'MMMM',
  dayMonth: 'DD MMMM',
  monthYear: 'MMMM YYYY',
  dayMonthYear: 'D MMMM YYYY',
  dayMonthYearOfficial: 'DD.MM.YYYY',
  dayMonthYearHourMinuteOfficial: 'DD.MM.YYYY HH:mm',
  dayMonthYearOfficialRaw: 'DDMMYYYY',
  dayMonthYearTime: 'D.MM.YY HH:mm',
  hoursMinutes: 'HH:mm',
  VutefyDatePicker: 'YYYY-MM-DD',
  backEnd: 'YYYY-MM-DD',
};

const timeFormatLength = {
  dayMonthYearOfficialRaw: 8,
};

export default {
  data: () => ({
    now: moment(),
  }),

  methods: {
    formatDate(date, formatTo, formatFrom) {
      return moment(date, timeFormats[formatFrom]).format(
        timeFormats[formatTo],
      );
    },

    getTimeFormatLength(format) {
      return timeFormatLength[format];
    },

    isValidDate(date, format) {
      const dateToCheck = moment(date, timeFormats[format]);

      return dateToCheck !== null && dateToCheck.isValid();
    },

    isBefore(date1, date2, format) {
      return moment(date1, timeFormats[format]).isBefore(
        moment(date2, timeFormats[format]),
      );
    },

    difference(date1, date2, format) {
      const date = moment.duration(
        moment(date1, timeFormats[format]).diff(
          moment(date2, timeFormats[format]),
        ),
      );

      return { hours: date.hours(), minutes: date.minutes() };
    },

    isAfter(date1, date2, format) {
      return moment(date1, timeFormats[format]).isAfter(
        moment(date2, timeFormats[format]),
      );
    },

    fromNow(date) {
      return moment(date).fromNow();
    },

    isTheSameDate(date1, date2, format) {
      return moment(date1, timeFormats[format]).isSame(
        moment(date2, timeFormats[format]),
      );
    },

    isTheSameDay(date1, date2, format) {
      const day1 = moment(date1, timeFormats[format]).day();
      const day2 = moment(date2, timeFormats[format]).day();

      return day1 === day2;
    },

    isTheSameMonth(date1, date2, format) {
      const month1 = moment(date1, timeFormats[format]).month();
      const month2 = moment(date2, timeFormats[format]).month();

      return month1 === month2;
    },

    isTheSameYear(date1, date2, format) {
      const year1 = moment(date1, timeFormats[format]).year();
      const year2 = moment(date2, timeFormats[format]).year();

      return year1 === year2;
    },

    getOffsetDay(date, offset, formatTo, formatFrom) {
      return this.formatDate(
        moment(date, timeFormats[formatFrom]).add(offset, 'days'),
        formatTo,
      );
    },
  },
};
