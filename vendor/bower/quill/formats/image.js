import Embed from '../blots/embed';
import Link, { sanitize } from '../formats/link';


class Image extends Embed {
  static create(value) {
    let node = super.create(value);
    if (typeof value === 'string') {
      node.setAttribute('src', this.sanitize(value));
    }
    return node;
  }

  static match(url) {
    return /\.(jpe?g|gif|png)$/.test(url);
  }

  static sanitize(url) {
    return sanitize(url, ['http', 'https', 'data']) ? url : '//:0';
  }

  static value(domNode) {
    return domNode.getAttribute('src');
  }
}
Image.blotName = 'image';
Image.tagName = 'IMG';


export default Image;
