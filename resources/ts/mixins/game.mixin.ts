import Vue from 'vue';
import { Mixin } from 'vue-mixin-decorator';

@Mixin
export default class GameMixin extends Vue {
  /**
   * Returns the value or converts it to 'Free' if zero.
   *
   * @param {Number} value
   * @return {String|Number}
   */
  public freeOrValue(value: number): string|number {
    if (value === 0) {
      return 'Free';
    }

    return value;
  }

  /**
   * Converts the first letter of the string to uppercase.
   *
   * @param {string} string
   * @returns {string}
   */
  public ucFirst(string: string): string {
    return string[0].toUpperCase() + string.slice(1);
  }
}
