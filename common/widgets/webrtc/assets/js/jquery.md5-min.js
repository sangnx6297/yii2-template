(function (z) {
    function n(a, g) {
        var b = (a & 65535) + (g & 65535);
        return (a >> 16) + (g >> 16) + (b >> 16) << 16 | b & 65535
    }

    function k(a, g, b, p, k, h) {
        a = n(n(g, a), n(p, h));
        return n(a << k | a >>> 32 - k, b)
    }

    function h(a, g, b, p, h, l, m) {
        return k(g & b | ~g & p, a, g, h, l, m)
    }

    function l(a, g, b, p, h, l, m) {
        return k(g & p | b & ~p, a, g, h, l, m)
    }

    function m(a, g, b, h, l, m, n) {
        return k(b ^ (g | ~h), a, g, l, m, n)
    }

    function q(a, g) {
        a[g >> 5] |= 128 << g % 32;
        a[(g + 64 >>> 9 << 4) + 14] = g;
        var b, p, t, u, q, c = 1732584193, d = -271733879, e = -1732584194, f = 271733878;
        for (b = 0; b < a.length; b += 16) p = c, t = d, u = e, q = f, c = h(c,
            d, e, f, a[b], 7, -680876936), f = h(f, c, d, e, a[b + 1], 12, -389564586), e = h(e, f, c, d, a[b + 2], 17, 606105819), d = h(d, e, f, c, a[b + 3], 22, -1044525330), c = h(c, d, e, f, a[b + 4], 7, -176418897), f = h(f, c, d, e, a[b + 5], 12, 1200080426), e = h(e, f, c, d, a[b + 6], 17, -1473231341), d = h(d, e, f, c, a[b + 7], 22, -45705983), c = h(c, d, e, f, a[b + 8], 7, 1770035416), f = h(f, c, d, e, a[b + 9], 12, -1958414417), e = h(e, f, c, d, a[b + 10], 17, -42063), d = h(d, e, f, c, a[b + 11], 22, -1990404162), c = h(c, d, e, f, a[b + 12], 7, 1804603682), f = h(f, c, d, e, a[b + 13], 12, -40341101), e = h(e, f, c, d, a[b + 14], 17, -1502002290),
            d = h(d, e, f, c, a[b + 15], 22, 1236535329), c = l(c, d, e, f, a[b + 1], 5, -165796510), f = l(f, c, d, e, a[b + 6], 9, -1069501632), e = l(e, f, c, d, a[b + 11], 14, 643717713), d = l(d, e, f, c, a[b], 20, -373897302), c = l(c, d, e, f, a[b + 5], 5, -701558691), f = l(f, c, d, e, a[b + 10], 9, 38016083), e = l(e, f, c, d, a[b + 15], 14, -660478335), d = l(d, e, f, c, a[b + 4], 20, -405537848), c = l(c, d, e, f, a[b + 9], 5, 568446438), f = l(f, c, d, e, a[b + 14], 9, -1019803690), e = l(e, f, c, d, a[b + 3], 14, -187363961), d = l(d, e, f, c, a[b + 8], 20, 1163531501), c = l(c, d, e, f, a[b + 13], 5, -1444681467), f = l(f, c, d, e, a[b + 2], 9, -51403784),
            e = l(e, f, c, d, a[b + 7], 14, 1735328473), d = l(d, e, f, c, a[b + 12], 20, -1926607734), c = k(d ^ e ^ f, c, d, a[b + 5], 4, -378558), f = k(c ^ d ^ e, f, c, a[b + 8], 11, -2022574463), e = k(f ^ c ^ d, e, f, a[b + 11], 16, 1839030562), d = k(e ^ f ^ c, d, e, a[b + 14], 23, -35309556), c = k(d ^ e ^ f, c, d, a[b + 1], 4, -1530992060), f = k(c ^ d ^ e, f, c, a[b + 4], 11, 1272893353), e = k(f ^ c ^ d, e, f, a[b + 7], 16, -155497632), d = k(e ^ f ^ c, d, e, a[b + 10], 23, -1094730640), c = k(d ^ e ^ f, c, d, a[b + 13], 4, 681279174), f = k(c ^ d ^ e, f, c, a[b], 11, -358537222), e = k(f ^ c ^ d, e, f, a[b + 3], 16, -722521979), d = k(e ^ f ^ c, d, e, a[b + 6], 23, 76029189), c = k(d ^
            e ^ f, c, d, a[b + 9], 4, -640364487), f = k(c ^ d ^ e, f, c, a[b + 12], 11, -421815835), e = k(f ^ c ^ d, e, f, a[b + 15], 16, 530742520), d = k(e ^ f ^ c, d, e, a[b + 2], 23, -995338651), c = m(c, d, e, f, a[b], 6, -198630844), f = m(f, c, d, e, a[b + 7], 10, 1126891415), e = m(e, f, c, d, a[b + 14], 15, -1416354905), d = m(d, e, f, c, a[b + 5], 21, -57434055), c = m(c, d, e, f, a[b + 12], 6, 1700485571), f = m(f, c, d, e, a[b + 3], 10, -1894986606), e = m(e, f, c, d, a[b + 10], 15, -1051523), d = m(d, e, f, c, a[b + 1], 21, -2054922799), c = m(c, d, e, f, a[b + 8], 6, 1873313359), f = m(f, c, d, e, a[b + 15], 10, -30611744), e = m(e, f, c, d, a[b + 6], 15, -1560198380),
            d = m(d, e, f, c, a[b + 13], 21, 1309151649), c = m(c, d, e, f, a[b + 4], 6, -145523070), f = m(f, c, d, e, a[b + 11], 10, -1120210379), e = m(e, f, c, d, a[b + 2], 15, 718787259), d = m(d, e, f, c, a[b + 9], 21, -343485551), c = n(c, p), d = n(d, t), e = n(e, u), f = n(f, q);
        return [c, d, e, f]
    }

    function v(a) {
        var g, b = "";
        for (g = 0; g < 32 * a.length; g += 8) b += String.fromCharCode(a[g >> 5] >>> g % 32 & 255);
        return b
    }

    function r(a) {
        var g, b = [];
        b[(a.length >> 2) - 1] = void 0;
        for (g = 0; g < b.length; g += 1) b[g] = 0;
        for (g = 0; g < 8 * a.length; g += 8) b[g >> 5] |= (a.charCodeAt(g / 8) & 255) << g % 32;
        return b
    }

    function w(a) {
        return v(q(r(a),
            8 * a.length))
    }

    function x(a, g) {
        var b, h = r(a), k = [], l = [];
        k[15] = l[15] = void 0;
        16 < h.length && (h = q(h, 8 * a.length));
        for (b = 0; 16 > b; b += 1) k[b] = h[b] ^ 909522486, l[b] = h[b] ^ 1549556828;
        b = q(k.concat(r(g)), 512 + 8 * g.length);
        return v(q(l.concat(b), 640))
    }

    function y(a) {
        var g = "", b, h;
        for (h = 0; h < a.length; h += 1) b = a.charCodeAt(h), g += "0123456789abcdef".charAt(b >>> 4 & 15) + "0123456789abcdef".charAt(b & 15);
        return g
    }

    z.md5 = function (a, g, b) {
        g ? b ? a = x(unescape(encodeURIComponent(g)), unescape(encodeURIComponent(a))) : (a = x(unescape(encodeURIComponent(g)),
            unescape(encodeURIComponent(a))), a = y(a)) : a = b ? w(unescape(encodeURIComponent(a))) : y(w(unescape(encodeURIComponent(a))));
        return a
    }
})("function" === typeof jQuery ? jQuery : this);