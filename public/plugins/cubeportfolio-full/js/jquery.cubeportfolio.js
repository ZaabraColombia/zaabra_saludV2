/*
* Cube Portfolio - Responsive jQuery Grid Plugin
*
* version: 4.4.0 (1 August, 2018)
* require: jQuery v1.8+
*
* Copyright 2013-2018, Mihai Buricea (http://scriptpie.com/cubeportfolio/live-preview/)
* Licensed under CodeCanyon License (http://codecanyon.net/licenses)
*
*/

!function(s, t, a, r) {
    "use strict";
    function l(t, e, n) {
        var i = this;
        if (s.data(t, "cubeportfolio"))
            throw new Error("cubeportfolio is already initialized. Destroy it before initialize again!");
        i.obj = t,
            i.$obj = s(t),
            s.data(i.obj, "cubeportfolio", i),
        e && e.sortToPreventGaps !== r && (e.sortByDimension = e.sortToPreventGaps,
            delete e.sortToPreventGaps),
            i.options = s.extend({}, s.fn.cubeportfolio.options, e, i.$obj.data("cbp-options")),
            i.isAnimating = !0,
            i.defaultFilter = i.options.defaultFilter,
            i.registeredEvents = [],
            i.queue = [],
            i.addedWrapp = !1,
        s.isFunction(n) && i.registerEvent("initFinish", n, !0);
        var o = i.$obj.children();
        i.$obj.addClass("cbp"),
        (0 === o.length || o.first().hasClass("cbp-item")) && (i.wrapInner(i.obj, "cbp-wrapper"),
            i.addedWrapp = !0),
            i.$ul = i.$obj.children().addClass("cbp-wrapper"),
            i.wrapInner(i.obj, "cbp-wrapper-outer"),
            i.wrapper = i.$obj.children(".cbp-wrapper-outer"),
            i.blocks = i.$ul.children(".cbp-item"),
            i.blocksOn = i.blocks,
            i.wrapInner(i.blocks, "cbp-item-wrapper"),
            i.plugins = {},
            s.each(l.plugins, function(t, e) {
                var n = e(i);
                n && (i.plugins[t] = n)
            }),
            i.triggerEvent("afterPlugins"),
            i.removeAttrAfterStoreData = s.Deferred(),
            i.loadImages(i.$obj, i.display)
    }
    s.extend(l.prototype, {
        storeData: function(t, a) {
            var r = this;
            a = a || 0,
                t.each(function(t, e) {
                    var n = s(e)
                        , i = n.width()
                        , o = n.height();
                    n.data("cbp", {
                        index: a + t,
                        indexInitial: a + t,
                        wrapper: n.children(".cbp-item-wrapper"),
                        widthInitial: i,
                        heightInitial: o,
                        width: i,
                        height: o,
                        widthAndGap: i + r.options.gapVertical,
                        heightAndGap: o + r.options.gapHorizontal,
                        left: null,
                        leftNew: null,
                        top: null,
                        topNew: null,
                        pack: !1
                    })
                }),
                this.removeAttrAfterStoreData.resolve()
        },
        wrapInner: function(t, e) {
            var n, i, o;
            if (e = e || "",
                !(t.length && t.length < 1))
                for (t.length === r && (t = [t]),
                         i = t.length - 1; 0 <= i; i--) {
                    for (n = t[i],
                             (o = a.createElement("div")).setAttribute("class", e); n.childNodes.length; )
                        o.appendChild(n.childNodes[0]);
                    n.appendChild(o)
                }
        },
        removeAttrImage: function(t) {
            this.removeAttrAfterStoreData.then(function() {
                t.removeAttribute("width"),
                    t.removeAttribute("height"),
                    t.removeAttribute("style")
            })
        },
        loadImages: function(e, o) {
            var a = this;
            requestAnimationFrame(function() {
                var t = e.find("img").map(function(t, e) {
                    if (e.hasAttribute("width") && e.hasAttribute("height")) {
                        if (e.style.width = e.getAttribute("width") + "px",
                            e.style.height = e.getAttribute("height") + "px",
                            e.hasAttribute("data-cbp-src"))
                            return null;
                        if (null === a.checkSrc(e))
                            a.removeAttrImage(e);
                        else {
                            var n = s("<img>");
                            n.on("load.cbp error.cbp", function() {
                                s(this).off("load.cbp error.cbp"),
                                    a.removeAttrImage(e)
                            }),
                                e.srcset ? (n.attr("sizes", e.sizes || "100vw"),
                                    n.attr("srcset", e.srcset)) : n.attr("src", e.src)
                        }
                        return null
                    }
                    return a.checkSrc(e)
                })
                    , i = t.length;
                0 !== i ? s.each(t, function(t, e) {
                    var n = s("<img>");
                    n.on("load.cbp error.cbp", function() {
                        s(this).off("load.cbp error.cbp"),
                        0 === --i && o.call(a)
                    }),
                        e.srcset ? (n.attr("sizes", e.sizes),
                            n.attr("srcset", e.srcset)) : n.attr("src", e.src)
                }) : o.call(a)
            })
        },
        checkSrc: function(t) {
            var e = t.srcset
                , n = t.src;
            if ("" === n)
                return null;
            var i = s("<img>");
            e ? (i.attr("sizes", t.sizes || "100vw"),
                i.attr("srcset", e)) : i.attr("src", n);
            var o = i[0];
            return o.complete && o.naturalWidth !== r && 0 !== o.naturalWidth ? null : o
        },
        display: function() {
            var t = this;
            t.width = t.$obj.outerWidth(),
                t.triggerEvent("initStartRead"),
                t.triggerEvent("initStartWrite"),
            0 < t.width && (t.storeData(t.blocks),
                t.layoutAndAdjustment()),
                t.triggerEvent("initEndRead"),
                t.triggerEvent("initEndWrite"),
                t.$obj.addClass("cbp-ready"),
                t.runQueue("delayFrame", t.delayFrame)
        },
        delayFrame: function() {
            var t = this;
            requestAnimationFrame(function() {
                t.resizeEvent(),
                    t.triggerEvent("initFinish"),
                    t.isAnimating = !1,
                    t.$obj.trigger("initComplete.cbp")
            })
        },
        resizeEvent: function() {
            var e = this;
            l["private"].resize.initEvent({
                instance: e,
                fn: function() {
                    e.triggerEvent("beforeResizeGrid");
                    var t = e.$obj.outerWidth();
                    t && e.width !== t && (e.width = t,
                    "alignCenter" === e.options.gridAdjustment && (e.wrapper[0].style.maxWidth = ""),
                        e.layoutAndAdjustment(),
                        e.triggerEvent("resizeGrid")),
                        e.triggerEvent("resizeWindow")
                }
            })
        },
        gridAdjust: function() {
            var r = this;
            "responsive" === r.options.gridAdjustment ? r.responsiveLayout() : (r.blocks.removeAttr("style"),
                r.blocks.each(function(t, e) {
                    var n = s(e).data("cbp")
                        , i = e.getBoundingClientRect()
                        , o = r.columnWidthTruncate(i.right - i.left)
                        , a = Math.round(i.bottom - i.top);
                    n.height = a,
                        n.heightAndGap = a + r.options.gapHorizontal,
                        n.width = o,
                        n.widthAndGap = o + r.options.gapVertical
                }),
                r.widthAvailable = r.width + r.options.gapVertical),
                r.triggerEvent("gridAdjust")
        },
        layoutAndAdjustment: function(t) {
            t && (this.width = this.$obj.outerWidth()),
                this.gridAdjust(),
                this.layout()
        },
        layout: function() {
            var t = this;
            t.computeBlocks(t.filterConcat(t.defaultFilter)),
                "slider" === t.options.layoutMode ? (t.sliderLayoutReset(),
                    t.sliderLayout()) : (t.mosaicLayoutReset(),
                    t.mosaicLayout()),
                t.blocksOff.addClass("cbp-item-off"),
                t.blocksOn.removeClass("cbp-item-off").each(function(t, e) {
                    var n = s(e).data("cbp");
                    n.left = n.leftNew,
                        n.top = n.topNew,
                        e.style.left = n.left + "px",
                        e.style.top = n.top + "px"
                }),
                t.resizeMainContainer()
        },
        computeFilter: function(t) {
            this.computeBlocks(t),
                this.mosaicLayoutReset(),
                this.mosaicLayout(),
                this.filterLayout()
        },
        filterLayout: function() {
            this.blocksOff.addClass("cbp-item-off"),
                this.blocksOn.removeClass("cbp-item-off").each(function(t, e) {
                    var n = s(e).data("cbp");
                    n.left = n.leftNew,
                        n.top = n.topNew,
                        e.style.left = n.left + "px",
                        e.style.top = n.top + "px"
                }),
                this.resizeMainContainer(),
                this.filterFinish()
        },
        filterFinish: function() {
            this.isAnimating = !1,
                this.$obj.trigger("filterComplete.cbp"),
                this.triggerEvent("filterFinish")
        },
        computeBlocks: function(t) {
            var e = this;
            e.blocksOnInitial = e.blocksOn,
                e.blocksOn = e.blocks.filter(t),
                e.blocksOff = e.blocks.not(t),
                e.triggerEvent("computeBlocksFinish", t)
        },
        responsiveLayout: function() {
            var a = this;
            a.cols = a[s.isArray(a.options.mediaQueries) ? "getColumnsBreakpoints" : "getColumnsAuto"](),
                a.columnWidth = a.columnWidthTruncate((a.width + a.options.gapVertical) / a.cols),
                a.widthAvailable = a.columnWidth * a.cols,
            "mosaic" === a.options.layoutMode && a.getMosaicWidthReference(),
                a.blocks.each(function(t, e) {
                    var n, i = s(e).data("cbp"), o = 1;
                    "mosaic" === a.options.layoutMode && (o = a.getColsMosaic(i.widthInitial)),
                        n = a.columnWidth * o - a.options.gapVertical,
                        e.style.width = n + "px",
                        i.width = n,
                        i.widthAndGap = n + a.options.gapVertical,
                        e.style.height = ""
                });
            var r = [];
            a.blocks.each(function(t, e) {
                s.each(s(e).find("img").filter("[width][height]"), function(t, e) {
                    var i = 0;
                    s(e).parentsUntil(".cbp-item").each(function(t, e) {
                        var n = s(e).width();
                        if (0 < n)
                            return i = n,
                                !1
                    });
                    var n = parseInt(e.getAttribute("width"), 10)
                        , o = parseInt(e.getAttribute("height"), 10)
                        , a = parseFloat((n / o).toFixed(10));
                    r.push({
                        el: e,
                        width: i,
                        height: Math.round(i / a)
                    })
                })
            }),
                s.each(r, function(t, e) {
                    e.el.width = e.width,
                        e.el.height = e.height,
                        e.el.style.width = e.width + "px",
                        e.el.style.height = e.height + "px"
                }),
                a.blocks.each(function(t, e) {
                    var n = s(e).data("cbp")
                        , i = e.getBoundingClientRect()
                        , o = Math.round(i.bottom - i.top);
                    n.height = o,
                        n.heightAndGap = o + a.options.gapHorizontal
                })
        },
        getMosaicWidthReference: function() {
            var i = [];
            this.blocks.each(function(t, e) {
                var n = s(e).data("cbp");
                i.push(n.widthInitial)
            }),
                i.sort(function(t, e) {
                    return t - e
                }),
                i[0] ? this.mosaicWidthReference = i[0] : this.mosaicWidthReference = this.columnWidth
        },
        getColsMosaic: function(t) {
            if (t === this.width)
                return this.cols;
            var e = t / this.mosaicWidthReference;
            return e = .79 <= e % 1 ? Math.ceil(e) : Math.floor(e),
                Math.min(Math.max(e, 1), this.cols)
        },
        getColumnsAuto: function() {
            if (0 === this.blocks.length)
                return 1;
            var t = this.blocks.first().data("cbp").widthInitial + this.options.gapVertical;
            return Math.max(Math.round(this.width / t), 1)
        },
        getColumnsBreakpoints: function() {
            var n, t = this, i = t.width;
            return s.each(t.options.mediaQueries, function(t, e) {
                if (i >= e.width)
                    return n = e,
                        !1
            }),
            n || (n = t.options.mediaQueries[t.options.mediaQueries.length - 1]),
                t.triggerEvent("onMediaQueries", n.options),
                n.cols
        },
        columnWidthTruncate: function(t) {
            return Math.floor(t)
        },
        resizeMainContainer: function() {
            var o, t = this, e = Math.max(t.freeSpaces.slice(-1)[0].topStart - t.options.gapHorizontal, 0);
            "alignCenter" === t.options.gridAdjustment && (o = 0,
                t.blocksOn.each(function(t, e) {
                    var n = s(e).data("cbp")
                        , i = n.left + n.width;
                    o < i && (o = i)
                }),
                t.wrapper[0].style.maxWidth = o + "px"),
            e !== t.height && (t.obj.style.height = e + "px",
            t.height !== r && (l["private"].modernBrowser ? t.$obj.one(l["private"].transitionend, function() {
                t.$obj.trigger("pluginResize.cbp")
            }) : t.$obj.trigger("pluginResize.cbp")),
                t.height = e),
                t.triggerEvent("resizeMainContainer")
        },
        filterConcat: function(t) {
            return t.replace(/\|/gi, "")
        },
        pushQueue: function(t, e) {
            this.queue[t] = this.queue[t] || [],
                this.queue[t].push(e)
        },
        runQueue: function(t, e) {
            var n = this.queue[t] || [];
            s.when.apply(s, n).then(s.proxy(e, this))
        },
        clearQueue: function(t) {
            this.queue[t] = []
        },
        registerEvent: function(t, e, n) {
            this.registeredEvents[t] || (this.registeredEvents[t] = []),
                this.registeredEvents[t].push({
                    func: e,
                    oneTime: n || !1
                })
        },
        triggerEvent: function(t, e) {
            var n, i, o = this;
            if (o.registeredEvents[t])
                for (n = 0,
                         i = o.registeredEvents[t].length; n < i; n++)
                    o.registeredEvents[t][n].func.call(o, e),
                    o.registeredEvents[t][n].oneTime && (o.registeredEvents[t].splice(n, 1),
                        n--,
                        i--)
        },
        addItems: function(t, e, i) {
            var o = this;
            o.wrapInner(t, "cbp-item-wrapper"),
                o.$ul[i](t.addClass("cbp-item-loading").css({
                    top: "100%",
                    left: 0
                })),
                l["private"].modernBrowser ? t.last().one(l["private"].animationend, function() {
                    o.addItemsFinish(t, e)
                }) : o.addItemsFinish(t, e),
                o.loadImages(t, function() {
                    if (o.$obj.addClass("cbp-updateItems"),
                    "append" === i)
                        o.storeData(t, o.blocks.length),
                            s.merge(o.blocks, t);
                    else {
                        o.storeData(t);
                        var n = t.length;
                        o.blocks.each(function(t, e) {
                            s(e).data("cbp").index = n + t
                        }),
                            o.blocks = s.merge(t, o.blocks)
                    }
                    o.triggerEvent("addItemsToDOM", t),
                        o.triggerEvent("triggerSort"),
                        o.layoutAndAdjustment(!0),
                    o.elems && l["public"].showCounter.call(o.obj, o.elems)
                })
        },
        addItemsFinish: function(t, e) {
            this.isAnimating = !1,
                this.$obj.removeClass("cbp-updateItems"),
                t.removeClass("cbp-item-loading"),
            s.isFunction(e) && e.call(this, t),
                this.$obj.trigger("onAfterLoadMore.cbp", [t])
        },
        removeItems: function(t, e) {
            var o = this;
            o.$obj.addClass("cbp-updateItems"),
                l["private"].modernBrowser ? t.last().one(l["private"].animationend, function() {
                    o.removeItemsFinish(t, e)
                }) : o.removeItemsFinish(t, e),
                t.each(function(t, i) {
                    o.blocks.each(function(t, e) {
                        if (i === e) {
                            var n = s(e);
                            o.blocks.splice(t, 1),
                                l["private"].modernBrowser ? (n.one(l["private"].animationend, function() {
                                    n.remove()
                                }),
                                    n.addClass("cbp-removeItem")) : n.remove()
                        }
                    })
                }),
                o.blocks.each(function(t, e) {
                    s(e).data("cbp").index = t
                }),
                o.triggerEvent("triggerSort"),
                o.layoutAndAdjustment(!0),
            o.elems && l["public"].showCounter.call(o.obj, o.elems)
        },
        removeItemsFinish: function(t, e) {
            this.isAnimating = !1,
                this.$obj.removeClass("cbp-updateItems"),
            s.isFunction(e) && e.call(this, t)
        }
    }),
        s.fn.cubeportfolio = function(t, e, n) {
            return this.each(function() {
                if ("object" == typeof t || !t)
                    return l["public"].init.call(this, t, e);
                if (l["public"][t])
                    return l["public"][t].call(this, e, n);
                throw new Error("Method " + t + " does not exist on jquery.cubeportfolio.js")
            })
        }
        ,
        l.plugins = {},
        s.fn.cubeportfolio.constructor = l
}(jQuery, window, document),
    function(l, t, e, n) {
        "use strict";
        var i = l.fn.cubeportfolio.constructor;
        l.extend(i.prototype, {
            mosaicLayoutReset: function() {
                var n = this;
                n.blocksAreSorted = !1,
                    n.blocksOn.each(function(t, e) {
                        l(e).data("cbp").pack = !1,
                        n.options.sortByDimension && (e.style.height = "")
                    }),
                    n.freeSpaces = [{
                        leftStart: 0,
                        leftEnd: n.widthAvailable,
                        topStart: 0,
                        topEnd: Math.pow(2, 18)
                    }]
            },
            mosaicLayout: function() {
                for (var t = this, e = 0, n = t.blocksOn.length; e < n; e++) {
                    var i = t.getSpaceIndexAndBlock();
                    if (null === i)
                        return t.mosaicLayoutReset(),
                            t.blocksAreSorted = !0,
                            t.sortBlocks(t.blocksOn, "widthAndGap", "heightAndGap", !0),
                            void t.mosaicLayout();
                    t.generateF1F2(i.spaceIndex, i.dataBlock),
                        t.generateG1G2G3G4(i.dataBlock),
                        t.cleanFreeSpaces(),
                        t.addHeightToBlocks()
                }
                t.blocksAreSorted && t.sortBlocks(t.blocksOn, "topNew", "leftNew")
            },
            getSpaceIndexAndBlock: function() {
                var t = this
                    , s = null;
                return l.each(t.freeSpaces, function(i, o) {
                    var a = o.leftEnd - o.leftStart
                        , r = o.topEnd - o.topStart;
                    return t.blocksOn.each(function(t, e) {
                        var n = l(e).data("cbp");
                        if (!0 !== n.pack)
                            return n.widthAndGap <= a && n.heightAndGap <= r ? (n.pack = !0,
                                s = {
                                    spaceIndex: i,
                                    dataBlock: n
                                },
                                n.leftNew = o.leftStart,
                                n.topNew = o.topStart,
                                !1) : void 0
                    }),
                        !t.blocksAreSorted && t.options.sortByDimension && 0 < i ? (s = null,
                            !1) : null === s && void 0
                }),
                    s
            },
            generateF1F2: function(t, e) {
                var n = this.freeSpaces[t]
                    , i = {
                    leftStart: n.leftStart + e.widthAndGap,
                    leftEnd: n.leftEnd,
                    topStart: n.topStart,
                    topEnd: n.topEnd
                }
                    , o = {
                    leftStart: n.leftStart,
                    leftEnd: n.leftEnd,
                    topStart: n.topStart + e.heightAndGap,
                    topEnd: n.topEnd
                };
                this.freeSpaces.splice(t, 1),
                i.leftStart < i.leftEnd && i.topStart < i.topEnd && (this.freeSpaces.splice(t, 0, i),
                    t++),
                o.leftStart < o.leftEnd && o.topStart < o.topEnd && this.freeSpaces.splice(t, 0, o)
            },
            generateG1G2G3G4: function(i) {
                var o = this
                    , a = [];
                l.each(o.freeSpaces, function(t, e) {
                    var n = o.intersectSpaces(e, i);
                    null !== n ? (o.generateG1(e, n, a),
                        o.generateG2(e, n, a),
                        o.generateG3(e, n, a),
                        o.generateG4(e, n, a)) : a.push(e)
                }),
                    o.freeSpaces = a
            },
            intersectSpaces: function(t, e) {
                var n = {
                    leftStart: e.leftNew,
                    leftEnd: e.leftNew + e.widthAndGap,
                    topStart: e.topNew,
                    topEnd: e.topNew + e.heightAndGap
                };
                if (t.leftStart === n.leftStart && t.leftEnd === n.leftEnd && t.topStart === n.topStart && t.topEnd === n.topEnd)
                    return null;
                var i = Math.max(t.leftStart, n.leftStart)
                    , o = Math.min(t.leftEnd, n.leftEnd)
                    , a = Math.max(t.topStart, n.topStart)
                    , r = Math.min(t.topEnd, n.topEnd);
                return o <= i || r <= a ? null : {
                    leftStart: i,
                    leftEnd: o,
                    topStart: a,
                    topEnd: r
                }
            },
            generateG1: function(t, e, n) {
                t.topStart !== e.topStart && n.push({
                    leftStart: t.leftStart,
                    leftEnd: t.leftEnd,
                    topStart: t.topStart,
                    topEnd: e.topStart
                })
            },
            generateG2: function(t, e, n) {
                t.leftEnd !== e.leftEnd && n.push({
                    leftStart: e.leftEnd,
                    leftEnd: t.leftEnd,
                    topStart: t.topStart,
                    topEnd: t.topEnd
                })
            },
            generateG3: function(t, e, n) {
                t.topEnd !== e.topEnd && n.push({
                    leftStart: t.leftStart,
                    leftEnd: t.leftEnd,
                    topStart: e.topEnd,
                    topEnd: t.topEnd
                })
            },
            generateG4: function(t, e, n) {
                t.leftStart !== e.leftStart && n.push({
                    leftStart: t.leftStart,
                    leftEnd: e.leftStart,
                    topStart: t.topStart,
                    topEnd: t.topEnd
                })
            },
            cleanFreeSpaces: function() {
                this.freeSpaces.sort(function(t, e) {
                    return t.topStart > e.topStart ? 1 : t.topStart < e.topStart ? -1 : t.leftStart > e.leftStart ? 1 : t.leftStart < e.leftStart ? -1 : 0
                }),
                    this.correctSubPixelValues(),
                    this.removeNonMaximalFreeSpaces()
            },
            correctSubPixelValues: function() {
                var t, e, n, i;
                for (t = 0,
                         e = this.freeSpaces.length - 1; t < e; t++)
                    n = this.freeSpaces[t],
                    (i = this.freeSpaces[t + 1]).topStart - n.topStart <= 1 && (i.topStart = n.topStart)
            },
            removeNonMaximalFreeSpaces: function() {
                var t = this;
                t.uniqueFreeSpaces(),
                    t.freeSpaces = l.map(t.freeSpaces, function(n, i) {
                        return l.each(t.freeSpaces, function(t, e) {
                            if (i !== t)
                                return e.leftStart <= n.leftStart && e.leftEnd >= n.leftEnd && e.topStart <= n.topStart && e.topEnd >= n.topEnd ? (n = null,
                                    !1) : void 0
                        }),
                            n
                    })
            },
            uniqueFreeSpaces: function() {
                var e = [];
                l.each(this.freeSpaces, function(t, n) {
                    l.each(e, function(t, e) {
                        if (e.leftStart === n.leftStart && e.leftEnd === n.leftEnd && e.topStart === n.topStart && e.topEnd === n.topEnd)
                            return n = null,
                                !1
                    }),
                    null !== n && e.push(n)
                }),
                    this.freeSpaces = e
            },
            addHeightToBlocks: function() {
                var o = this;
                l.each(o.freeSpaces, function(t, i) {
                    o.blocksOn.each(function(t, e) {
                        var n = l(e).data("cbp");
                        !0 === n.pack && (o.intersectSpaces(i, n) && -1 === i.topStart - n.topNew - n.heightAndGap && (e.style.height = n.height - 1 + "px"))
                    })
                })
            },
            sortBlocks: function(t, o, a, r) {
                a = void 0 === a ? "leftNew" : a,
                    r = void 0 === r ? 1 : -1,
                    t.sort(function(t, e) {
                        var n = l(t).data("cbp")
                            , i = l(e).data("cbp");
                        return n[o] > i[o] ? r : n[o] < i[o] ? -r : n[a] > i[a] ? r : n[a] < i[a] ? -r : n.index > i.index ? r : n.index < i.index ? -r : void 0
                    })
            }
        })
    }(jQuery, window, document),
    jQuery.fn.cubeportfolio.options = {
        filters: "",
        search: "",
        layoutMode: "grid",
        sortByDimension: !1,
        drag: !0,
        auto: !1,
        autoTimeout: 5e3,
        autoPauseOnHover: !0,
        showNavigation: !0,
        showPagination: !0,
        rewindNav: !0,
        scrollByPage: !1,
        defaultFilter: "*",
        filterDeeplinking: !1,
        animationType: "fadeOut",
        gridAdjustment: "responsive",
        mediaQueries: !1,
        gapHorizontal: 10,
        gapVertical: 10,
        caption: "pushTop",
        displayType: "fadeIn",
        displayTypeSpeed: 400,
        lightboxDelegate: ".cbp-lightbox",
        lightboxGallery: !0,
        lightboxTitleSrc: "data-title",
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        singlePageDelegate: ".cbp-singlePage",
        singlePageDeeplinking: !0,
        singlePageStickyNavigation: !0,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageAnimation: "left",
        singlePageCallback: null,
        singlePageInlineDelegate: ".cbp-singlePageInline",
        singlePageInlineDeeplinking: !1,
        singlePageInlinePosition: "top",
        singlePageInlineInFocus: !0,
        singlePageInlineCallback: null,
        plugins: {}
    },
    function(a, o, r, t) {
        "use strict";
        var s = a.fn.cubeportfolio.constructor
            , l = a(o);
        s["private"] = {
            publicEvents: function(e, n, i) {
                var o = this;
                o.events = [],
                    o.initEvent = function(t) {
                        0 === o.events.length && o.scrollEvent(),
                            o.events.push(t)
                    }
                    ,
                    o.destroyEvent = function(n) {
                        o.events = a.map(o.events, function(t, e) {
                            if (t.instance !== n)
                                return t
                        }),
                        0 === o.events.length && l.off(e)
                    }
                    ,
                    o.scrollEvent = function() {
                        var t;
                        l.on(e, function() {
                            clearTimeout(t),
                                t = setTimeout(function() {
                                    a.isFunction(i) && i.call(o) || a.each(o.events, function(t, e) {
                                        e.fn.call(e.instance)
                                    })
                                }, n)
                        })
                    }
            },
            checkInstance: function(t) {
                var e = a.data(this, "cubeportfolio");
                if (!e)
                    throw new Error("cubeportfolio is not initialized. Initialize it before calling " + t + " method!");
                return e.triggerEvent("publicMethod"),
                    e
            },
            browserInfo: function() {
                var t, e, n = s["private"], i = navigator.appVersion;
                -1 !== i.indexOf("MSIE 8.") ? n.browser = "ie8" : -1 !== i.indexOf("MSIE 9.") ? n.browser = "ie9" : -1 !== i.indexOf("MSIE 10.") ? n.browser = "ie10" : o.ActiveXObject || "ActiveXObject"in o ? n.browser = "ie11" : /android/gi.test(i) ? n.browser = "android" : /iphone|ipad|ipod/gi.test(i) ? n.browser = "ios" : /chrome/gi.test(i) ? n.browser = "chrome" : n.browser = "",
                void 0 !== typeof n.styleSupport("perspective") && (t = n.styleSupport("transition"),
                    n.transitionend = {
                        WebkitTransition: "webkitTransitionEnd",
                        transition: "transitionend"
                    }[t],
                    e = n.styleSupport("animation"),
                    n.animationend = {
                        WebkitAnimation: "webkitAnimationEnd",
                        animation: "animationend"
                    }[e],
                    n.animationDuration = {
                        WebkitAnimation: "webkitAnimationDuration",
                        animation: "animationDuration"
                    }[e],
                    n.animationDelay = {
                        WebkitAnimation: "webkitAnimationDelay",
                        animation: "animationDelay"
                    }[e],
                    n.transform = n.styleSupport("transform"),
                t && e && n.transform && (n.modernBrowser = !0))
            },
            styleSupport: function(t) {
                var e, n = "Webkit" + t.charAt(0).toUpperCase() + t.slice(1), i = r.createElement("div");
                return t in i.style ? e = t : n in i.style && (e = n),
                    i = null,
                    e
            }
        },
            s["private"].browserInfo(),
            s["private"].resize = new s["private"].publicEvents("resize.cbp",50,function() {
                    if (o.innerHeight == screen.height)
                        return !0
                }
            )
    }(jQuery, window, document),
    function(a, t, e, n) {
        "use strict";
        var r = a.fn.cubeportfolio.constructor;
        r["public"] = {
            init: function(t, e) {
                new r(this,t,e)
            },
            destroy: function(t) {
                var e = r["private"].checkInstance.call(this, "destroy");
                e.triggerEvent("beforeDestroy"),
                    a.removeData(this, "cubeportfolio"),
                    e.blocks.removeData("cbp"),
                    e.$obj.removeClass("cbp-ready").removeAttr("style"),
                    e.$ul.removeClass("cbp-wrapper"),
                    r["private"].resize.destroyEvent(e),
                    e.$obj.off(".cbp"),
                    e.blocks.removeClass("cbp-item-off").removeAttr("style"),
                    e.blocks.find(".cbp-item-wrapper").each(function(t, e) {
                        var n = a(e)
                            , i = n.children();
                        i.length ? i.unwrap() : n.remove()
                    }),
                e.destroySlider && e.destroySlider(),
                    e.$ul.unwrap(),
                e.addedWrapp && e.blocks.unwrap(),
                0 === e.blocks.length && e.$ul.remove(),
                    a.each(e.plugins, function(t, e) {
                        "function" == typeof e.destroy && e.destroy()
                    }),
                a.isFunction(t) && t.call(e),
                    e.triggerEvent("afterDestroy")
            },
            filter: function(t, e) {
                var n, i = r["private"].checkInstance.call(this, "filter");
                if (!i.isAnimating) {
                    if (i.isAnimating = !0,
                    a.isFunction(e) && i.registerEvent("filterFinish", e, !0),
                        a.isFunction(t)) {
                        if (void 0 === (n = t.call(i, i.blocks)))
                            throw new Error("When you call cubeportfolio API `filter` method with a param of type function you must return the blocks that will be visible.")
                    } else {
                        if (i.options.filterDeeplinking) {
                            var o = location.href.replace(/#cbpf=(.*?)([#\?&]|$)/gi, "");
                            location.href = o + "#cbpf=" + encodeURIComponent(t),
                            i.singlePage && i.singlePage.url && (i.singlePage.url = location.href)
                        }
                        i.defaultFilter = t,
                            n = i.filterConcat(i.defaultFilter)
                    }
                    i.triggerEvent("filterStart", n),
                        i.singlePageInline && i.singlePageInline.isOpen ? i.singlePageInline.close("promise", {
                            callback: function() {
                                i.computeFilter(n)
                            }
                        }) : i.computeFilter(n)
                }
            },
            showCounter: function(t, e) {
                var n = r["private"].checkInstance.call(this, "showCounter");
                a.isFunction(e) && n.registerEvent("showCounterFinish", e, !0),
                    (n.elems = t).each(function() {
                        var t = a(this)
                            , e = n.blocks.filter(t.data("filter")).length;
                        t.find(".cbp-filter-counter").text(e)
                    }),
                    n.triggerEvent("showCounterFinish", t)
            },
            appendItems: function(t, e) {
                r["public"].append.call(this, t, e)
            },
            append: function(t, e) {
                var n = r["private"].checkInstance.call(this, "append")
                    , i = a(t).filter(".cbp-item");
                n.isAnimating || i.length < 1 ? a.isFunction(e) && e.call(n, i) : (n.isAnimating = !0,
                    n.singlePageInline && n.singlePageInline.isOpen ? n.singlePageInline.close("promise", {
                        callback: function() {
                            n.addItems(i, e, "append")
                        }
                    }) : n.addItems(i, e, "append"))
            },
            prepend: function(t, e) {
                var n = r["private"].checkInstance.call(this, "prepend")
                    , i = a(t).filter(".cbp-item");
                n.isAnimating || i.length < 1 ? a.isFunction(e) && e.call(n, i) : (n.isAnimating = !0,
                    n.singlePageInline && n.singlePageInline.isOpen ? n.singlePageInline.close("promise", {
                        callback: function() {
                            n.addItems(i, e, "prepend")
                        }
                    }) : n.addItems(i, e, "prepend"))
            },
            remove: function(t, e) {
                var n = r["private"].checkInstance.call(this, "remove")
                    , i = a(t).filter(".cbp-item");
                n.isAnimating || i.length < 1 ? a.isFunction(e) && e.call(n, i) : (n.isAnimating = !0,
                    n.singlePageInline && n.singlePageInline.isOpen ? n.singlePageInline.close("promise", {
                        callback: function() {
                            n.removeItems(i, e)
                        }
                    }) : n.removeItems(i, e))
            },
            layout: function(t) {
                var e = r["private"].checkInstance.call(this, "layout");
                e.width = e.$obj.outerWidth(),
                e.isAnimating || e.width <= 0 || ("alignCenter" === e.options.gridAdjustment && (e.wrapper[0].style.maxWidth = ""),
                    e.storeData(e.blocks),
                    e.layoutAndAdjustment()),
                a.isFunction(t) && t.call(e)
            }
        }
    }(jQuery, window, document),
    function(h, t, b, e) {
        "use strict";
        var v = h.fn.cubeportfolio.constructor;
        h.extend(v.prototype, {
            updateSliderPagination: function() {
                var t, e, n = this;
                if (n.options.showPagination) {
                    for (t = Math.ceil(n.blocksOn.length / n.cols),
                             n.navPagination.empty(),
                             e = t - 1; 0 <= e; e--)
                        h("<div/>", {
                            "class": "cbp-nav-pagination-item",
                            "data-slider-action": "jumpTo"
                        }).appendTo(n.navPagination);
                    n.navPaginationItems = n.navPagination.children()
                }
                n.enableDisableNavSlider()
            },
            destroySlider: function() {
                var t = this;
                "slider" === t.options.layoutMode && (t.$obj.removeClass("cbp-mode-slider"),
                    t.$ul.removeAttr("style"),
                    t.$ul.off(".cbp"),
                    h(b).off(".cbp"),
                t.options.auto && t.stopSliderAuto())
            },
            nextSlider: function(t) {
                var e = this;
                if (e.isEndSlider()) {
                    if (!e.isRewindNav())
                        return;
                    e.sliderActive = 0
                } else
                    e.options.scrollByPage ? e.sliderActive = Math.min(e.sliderActive + e.cols, e.blocksOn.length - e.cols) : e.sliderActive += 1;
                e.goToSlider()
            },
            prevSlider: function(t) {
                var e = this;
                if (e.isStartSlider()) {
                    if (!e.isRewindNav())
                        return;
                    e.sliderActive = e.blocksOn.length - e.cols
                } else
                    e.options.scrollByPage ? e.sliderActive = Math.max(0, e.sliderActive - e.cols) : e.sliderActive -= 1;
                e.goToSlider()
            },
            jumpToSlider: function(t) {
                var e = this
                    , n = Math.min(t.index() * e.cols, e.blocksOn.length - e.cols);
                n !== e.sliderActive && (e.sliderActive = n,
                    e.goToSlider())
            },
            jumpDragToSlider: function(t) {
                var e, n, i, o = this, a = 0 < t;
                o.options.scrollByPage ? (e = o.cols * o.columnWidth,
                    n = o.cols) : (e = o.columnWidth,
                    n = 1),
                    t = Math.abs(t),
                    i = Math.floor(t / e) * n,
                20 < t % e && (i += n),
                    o.sliderActive = a ? Math.min(o.sliderActive + i, o.blocksOn.length - o.cols) : Math.max(0, o.sliderActive - i),
                    o.goToSlider()
            },
            isStartSlider: function() {
                return 0 === this.sliderActive
            },
            isEndSlider: function() {
                return this.sliderActive + this.cols > this.blocksOn.length - 1
            },
            goToSlider: function() {
                this.enableDisableNavSlider(),
                    this.updateSliderPosition()
            },
            startSliderAuto: function() {
                var t = this;
                t.isDrag ? t.stopSliderAuto() : t.timeout = setTimeout(function() {
                    t.nextSlider(),
                        t.startSliderAuto()
                }, t.options.autoTimeout)
            },
            stopSliderAuto: function() {
                clearTimeout(this.timeout)
            },
            enableDisableNavSlider: function() {
                var t, e, n = this;
                n.isRewindNav() || (e = n.isStartSlider() ? "addClass" : "removeClass",
                    n.navPrev[e]("cbp-nav-stop"),
                    e = n.isEndSlider() ? "addClass" : "removeClass",
                    n.navNext[e]("cbp-nav-stop")),
                n.options.showPagination && (t = n.options.scrollByPage ? Math.ceil(n.sliderActive / n.cols) : n.isEndSlider() ? n.navPaginationItems.length - 1 : Math.floor(n.sliderActive / n.cols),
                    n.navPaginationItems.removeClass("cbp-nav-pagination-active").eq(t).addClass("cbp-nav-pagination-active")),
                n.customPagination && (t = n.options.scrollByPage ? Math.ceil(n.sliderActive / n.cols) : n.isEndSlider() ? n.customPaginationItems.length - 1 : Math.floor(n.sliderActive / n.cols),
                    n.customPaginationItems.removeClass(n.customPaginationClass).eq(t).addClass(n.customPaginationClass))
            },
            isRewindNav: function() {
                return !this.options.showNavigation || !(this.blocksOn.length <= this.cols) && !!this.options.rewindNav
            },
            sliderItemsLength: function() {
                return this.blocksOn.length <= this.cols
            },
            sliderLayout: function() {
                var i = this;
                i.blocksOn.each(function(t, e) {
                    var n = h(e).data("cbp");
                    n.leftNew = i.columnWidth * t,
                        n.topNew = 0,
                        i.sliderFreeSpaces.push({
                            topStart: n.heightAndGap
                        })
                }),
                    i.getFreeSpacesForSlider(),
                    i.$ul.width(i.columnWidth * i.blocksOn.length - i.options.gapVertical)
            },
            getFreeSpacesForSlider: function() {
                var t = this;
                t.freeSpaces = t.sliderFreeSpaces.slice(t.sliderActive, t.sliderActive + t.cols),
                    t.freeSpaces.sort(function(t, e) {
                        return t.topStart > e.topStart ? 1 : t.topStart < e.topStart ? -1 : void 0
                    })
            },
            updateSliderPosition: function() {
                var t = this
                    , e = -t.sliderActive * t.columnWidth;
                v["private"].modernBrowser ? t.$ul[0].style[v["private"].transform] = "translate3d(" + e + "px, 0px, 0)" : t.$ul[0].style.left = e + "px",
                    t.getFreeSpacesForSlider(),
                    t.resizeMainContainer()
            },
            dragSlider: function() {
                var n, i, e, o, a, r = this, s = h(b), l = !1, p = {}, c = !1;
                function u(t) {
                    r.$obj.removeClass("cbp-mode-slider-dragStart"),
                        l = !0,
                        0 !== i ? (e.one("click.cbp", function(t) {
                            return !1
                        }),
                            requestAnimationFrame(function() {
                                r.jumpDragToSlider(i),
                                    r.$ul.one(v["private"].transitionend, f)
                            })) : f.call(r),
                        s.off(p.move),
                        s.off(p.end)
                }
                function d(t) {
                    (8 < (i = n - g(t).x) || i < -8) && t.preventDefault(),
                        r.isDrag = !0;
                    var e = o - i;
                    i < 0 && i < o ? e = (o - i) / 5 : 0 < i && o - i < -a && (e = (a + o - i) / 5 - a),
                        v["private"].modernBrowser ? r.$ul[0].style[v["private"].transform] = "translate3d(" + e + "px, 0px, 0)" : r.$ul[0].style.left = e + "px"
                }
                function f() {
                    if (l = !1,
                        r.isDrag = !1,
                        r.options.auto) {
                        if (r.mouseIsEntered)
                            return;
                        r.startSliderAuto()
                    }
                }
                function g(t) {
                    return void 0 !== t.originalEvent && void 0 !== t.originalEvent.touches && (t = t.originalEvent.touches[0]),
                        {
                            x: t.pageX,
                            y: t.pageY
                        }
                }
                r.isDrag = !1,
                    "ontouchstart"in t || 0 < navigator.maxTouchPoints || 0 < navigator.msMaxTouchPoints ? (p = {
                        start: "touchstart.cbp",
                        move: "touchmove.cbp",
                        end: "touchend.cbp"
                    },
                        c = !0) : p = {
                        start: "mousedown.cbp",
                        move: "mousemove.cbp",
                        end: "mouseup.cbp"
                    },
                    r.$ul.on(p.start, function(t) {
                        r.sliderItemsLength() || (c ? t : t.preventDefault(),
                        r.options.auto && r.stopSliderAuto(),
                            l ? h(e).one("click.cbp", function() {
                                return !1
                            }) : (e = h(t.target),
                                n = g(t).x,
                                i = 0,
                                o = -r.sliderActive * r.columnWidth,
                                a = r.columnWidth * (r.blocksOn.length - r.cols),
                                s.on(p.move, d),
                                s.on(p.end, u),
                                r.$obj.addClass("cbp-mode-slider-dragStart")))
                    })
            },
            sliderLayoutReset: function() {
                this.freeSpaces = [],
                    this.sliderFreeSpaces = []
            }
        })
    }(jQuery, window, document),
"function" != typeof Object.create && (Object.create = function(t) {
        function e() {}
        return e.prototype = t,
            new e
    }
),
    function() {
        for (var a = 0, t = ["moz", "webkit"], e = 0; e < t.length && !window.requestAnimationFrame; e++)
            window.requestAnimationFrame = window[t[e] + "RequestAnimationFrame"],
                window.cancelAnimationFrame = window[t[e] + "CancelAnimationFrame"] || window[t[e] + "CancelRequestAnimationFrame"];
        window.requestAnimationFrame || (window.requestAnimationFrame = function(t, e) {
                var n = (new Date).getTime()
                    , i = Math.max(0, 16 - (n - a))
                    , o = window.setTimeout(function() {
                    t(n + i)
                }, i);
                return a = n + i,
                    o
            }
        ),
        window.cancelAnimationFrame || (window.cancelAnimationFrame = function(t) {
                clearTimeout(t)
            }
        )
    }(),
    function(i, t, e, n) {
        "use strict";
        var o = i.fn.cubeportfolio.constructor;
        function a(e) {
            (this.parent = e).filterLayout = this.filterLayout,
                e.registerEvent("computeBlocksFinish", function(t) {
                    e.blocksOn2On = e.blocksOnInitial.filter(t),
                        e.blocksOn2Off = e.blocksOnInitial.not(t)
                })
        }
        a.prototype.filterLayout = function() {
            var t = this;
            function e() {
                t.blocks.removeClass("cbp-item-on2off cbp-item-off2on cbp-item-on2on").each(function(t, e) {
                    var n = i(e).data("cbp");
                    n.left = n.leftNew,
                        n.top = n.topNew,
                        e.style.left = n.left + "px",
                        e.style.top = n.top + "px",
                        e.style[o["private"].transform] = ""
                }),
                    t.blocksOff.addClass("cbp-item-off"),
                    t.$obj.removeClass("cbp-animation-" + t.options.animationType),
                    t.filterFinish()
            }
            t.$obj.addClass("cbp-animation-" + t.options.animationType),
                t.blocksOn2On.addClass("cbp-item-on2on").each(function(t, e) {
                    var n = i(e).data("cbp");
                    e.style[o["private"].transform] = "translate3d(" + (n.leftNew - n.left) + "px, " + (n.topNew - n.top) + "px, 0)"
                }),
                t.blocksOn2Off.addClass("cbp-item-on2off"),
                t.blocksOff2On = t.blocksOn.filter(".cbp-item-off").removeClass("cbp-item-off").addClass("cbp-item-off2on").each(function(t, e) {
                    var n = i(e).data("cbp");
                    e.style.left = n.leftNew + "px",
                        e.style.top = n.topNew + "px"
                }),
                t.blocksOn2Off.length ? t.blocksOn2Off.last().data("cbp").wrapper.one(o["private"].animationend, e) : t.blocksOff2On.length ? t.blocksOff2On.last().data("cbp").wrapper.one(o["private"].animationend, e) : t.blocksOn2On.length ? t.blocksOn2On.last().one(o["private"].transitionend, e) : e(),
                t.resizeMainContainer()
        }
            ,
            a.prototype.destroy = function() {
                var t = this.parent;
                t.$obj.removeClass("cbp-animation-" + t.options.animationType)
            }
            ,
            o.plugins.animationClassic = function(t) {
                return !o["private"].modernBrowser || i.inArray(t.options.animationType, ["boxShadow", "fadeOut", "flipBottom", "flipOut", "quicksand", "scaleSides", "skew"]) < 0 ? null : new a(t)
            }
    }(jQuery, window, document),
    function(o, t, e, n) {
        "use strict";
        var a = o.fn.cubeportfolio.constructor;
        function i(t) {
            (this.parent = t).filterLayout = this.filterLayout
        }
        i.prototype.filterLayout = function() {
            var i = this
                , t = i.$ul[0].cloneNode(!0);
            function e() {
                i.wrapper[0].removeChild(t),
                "sequentially" === i.options.animationType && i.blocksOn.each(function(t, e) {
                    o(e).data("cbp").wrapper[0].style[a["private"].animationDelay] = ""
                }),
                    i.$obj.removeClass("cbp-animation-" + i.options.animationType),
                    i.filterFinish()
            }
            t.setAttribute("class", "cbp-wrapper-helper"),
                i.wrapper[0].insertBefore(t, i.$ul[0]),
                requestAnimationFrame(function() {
                    i.$obj.addClass("cbp-animation-" + i.options.animationType),
                        i.blocksOff.addClass("cbp-item-off"),
                        i.blocksOn.removeClass("cbp-item-off").each(function(t, e) {
                            var n = o(e).data("cbp");
                            n.left = n.leftNew,
                                n.top = n.topNew,
                                e.style.left = n.left + "px",
                                e.style.top = n.top + "px",
                            "sequentially" === i.options.animationType && (n.wrapper[0].style[a["private"].animationDelay] = 60 * t + "ms")
                        }),
                        i.blocksOn.length ? i.blocksOn.last().data("cbp").wrapper.one(a["private"].animationend, e) : i.blocksOnInitial.length ? i.blocksOnInitial.last().data("cbp").wrapper.one(a["private"].animationend, e) : e(),
                        i.resizeMainContainer()
                })
        }
            ,
            i.prototype.destroy = function() {
                var t = this.parent;
                t.$obj.removeClass("cbp-animation-" + t.options.animationType)
            }
            ,
            a.plugins.animationClone = function(t) {
                return !a["private"].modernBrowser || o.inArray(t.options.animationType, ["fadeOutTop", "slideLeft", "sequentially"]) < 0 ? null : new i(t)
            }
    }(jQuery, window, document),
    function(a, t, e, n) {
        "use strict";
        var r = a.fn.cubeportfolio.constructor;
        function i(t) {
            (this.parent = t).filterLayout = this.filterLayout
        }
        i.prototype.filterLayout = function() {
            var n = this
                , t = n.$ul.clone(!0, !0);
            t[0].setAttribute("class", "cbp-wrapper-helper"),
                n.wrapper[0].insertBefore(t[0], n.$ul[0]);
            var i = t.find(".cbp-item").not(".cbp-item-off");
            function o() {
                n.wrapper[0].removeChild(t[0]),
                    n.$obj.removeClass("cbp-animation-" + n.options.animationType),
                    n.blocks.each(function(t, e) {
                        a(e).data("cbp").wrapper[0].style[r["private"].animationDelay] = ""
                    }),
                    n.filterFinish()
            }
            n.blocksAreSorted && n.sortBlocks(i, "top", "left"),
                i.children(".cbp-item-wrapper").each(function(t, e) {
                    e.style[r["private"].animationDelay] = 50 * t + "ms"
                }),
                requestAnimationFrame(function() {
                    n.$obj.addClass("cbp-animation-" + n.options.animationType),
                        n.blocksOff.addClass("cbp-item-off"),
                        n.blocksOn.removeClass("cbp-item-off").each(function(t, e) {
                            var n = a(e).data("cbp");
                            n.left = n.leftNew,
                                n.top = n.topNew,
                                e.style.left = n.left + "px",
                                e.style.top = n.top + "px",
                                n.wrapper[0].style[r["private"].animationDelay] = 50 * t + "ms"
                        });
                    var t = n.blocksOn.length
                        , e = i.length;
                    0 === t && 0 === e ? o() : t < e ? i.last().children(".cbp-item-wrapper").one(r["private"].animationend, o) : n.blocksOn.last().data("cbp").wrapper.one(r["private"].animationend, o),
                        n.resizeMainContainer()
                })
        }
            ,
            i.prototype.destroy = function() {
                var t = this.parent;
                t.$obj.removeClass("cbp-animation-" + t.options.animationType)
            }
            ,
            r.plugins.animationCloneDelay = function(t) {
                return !r["private"].modernBrowser || a.inArray(t.options.animationType, ["3dflip", "flipOutDelay", "foldLeft", "frontRow", "rotateRoom", "rotateSides", "scaleDown", "slideDelay", "unfold"]) < 0 ? null : new i(t)
            }
    }(jQuery, window, document),
    function(i, t, e, n) {
        "use strict";
        var o = i.fn.cubeportfolio.constructor;
        function a(t) {
            (this.parent = t).filterLayout = this.filterLayout
        }
        a.prototype.filterLayout = function() {
            var t = this
                , e = t.$ul[0].cloneNode(!0);
            function n() {
                t.wrapper[0].removeChild(e),
                    t.$obj.removeClass("cbp-animation-" + t.options.animationType),
                    t.filterFinish()
            }
            e.setAttribute("class", "cbp-wrapper-helper"),
                t.wrapper[0].insertBefore(e, t.$ul[0]),
                requestAnimationFrame(function() {
                    t.$obj.addClass("cbp-animation-" + t.options.animationType),
                        t.blocksOff.addClass("cbp-item-off"),
                        t.blocksOn.removeClass("cbp-item-off").each(function(t, e) {
                            var n = i(e).data("cbp");
                            n.left = n.leftNew,
                                n.top = n.topNew,
                                e.style.left = n.left + "px",
                                e.style.top = n.top + "px"
                        }),
                        t.blocksOn.length ? t.$ul.one(o["private"].animationend, n) : t.blocksOnInitial.length ? i(e).one(o["private"].animationend, n) : n(),
                        t.resizeMainContainer()
                })
        }
            ,
            a.prototype.destroy = function() {
                var t = this.parent;
                t.$obj.removeClass("cbp-animation-" + t.options.animationType)
            }
            ,
            o.plugins.animationWrapper = function(t) {
                return !o["private"].modernBrowser || i.inArray(t.options.animationType, ["bounceBottom", "bounceLeft", "bounceTop", "moveLeft"]) < 0 ? null : new a(t)
            }
    }(jQuery, window, document),
    function(t, e, n, i) {
        "use strict";
        var o = t.fn.cubeportfolio.constructor;
        function a(t) {
            var e = this
                , n = t.options;
            e.parent = t,
                e.captionOn = n.caption,
                t.registerEvent("onMediaQueries", function(t) {
                    t && t.hasOwnProperty("caption") ? e.captionOn !== t.caption && (e.destroy(),
                        e.captionOn = t.caption,
                        e.init()) : e.captionOn !== n.caption && (e.destroy(),
                        e.captionOn = n.caption,
                        e.init())
                }),
                e.init()
        }
        a.prototype.init = function() {
            var t = this;
            "" != t.captionOn && ("expand" === t.captionOn || o["private"].modernBrowser || (t.parent.options.caption = t.captionOn = "minimal"),
                t.parent.$obj.addClass("cbp-caption-active cbp-caption-" + t.captionOn))
        }
            ,
            a.prototype.destroy = function() {
                this.parent.$obj.removeClass("cbp-caption-active cbp-caption-" + this.captionOn)
            }
            ,
            o.plugins.caption = function(t) {
                return new a(t)
            }
    }(jQuery, window, document),
    function(l, t, e, n) {
        "use strict";
        var i = l.fn.cubeportfolio.constructor;
        function o(s) {
            (this.parent = s).registerEvent("initFinish", function() {
                s.$obj.on("click.cbp", ".cbp-caption-defaultWrap", function(t) {
                    if (t.preventDefault(),
                        !s.isAnimating) {
                        s.isAnimating = !0;
                        var e = l(this)
                            , n = e.next()
                            , i = e.parent()
                            , o = {
                            position: "relative",
                            height: n.outerHeight(!0)
                        }
                            , a = {
                            position: "relative",
                            height: 0
                        };
                        if (s.$obj.addClass("cbp-caption-expand-active"),
                            i.hasClass("cbp-caption-expand-open")) {
                            var r = a;
                            a = o,
                                o = r,
                                i.removeClass("cbp-caption-expand-open")
                        }
                        n.css(o),
                            s.$obj.one("pluginResize.cbp", function() {
                                s.isAnimating = !1,
                                    s.$obj.removeClass("cbp-caption-expand-active"),
                                0 === o.height && (i.removeClass("cbp-caption-expand-open"),
                                    n.attr("style", ""))
                            }),
                            s.layoutAndAdjustment(!0),
                            n.css(a),
                            requestAnimationFrame(function() {
                                i.addClass("cbp-caption-expand-open"),
                                    n.css(o),
                                    s.triggerEvent("gridAdjust"),
                                    s.triggerEvent("resizeGrid")
                            })
                    }
                })
            }, !0)
        }
        o.prototype.destroy = function() {
            this.parent.$obj.find(".cbp-caption-defaultWrap").off("click.cbp").parent().removeClass("cbp-caption-expand-active")
        }
            ,
            i.plugins.captionExpand = function(t) {
                return "expand" !== t.options.caption ? null : new o(t)
            }
    }(jQuery, window, document),
    function(e, t, n, i) {
        "use strict";
        var o = e.fn.cubeportfolio.constructor;
        function a(n) {
            n.registerEvent("initEndWrite", function() {
                if (!(n.width <= 0)) {
                    var t = e.Deferred();
                    n.pushQueue("delayFrame", t),
                        n.blocksOn.each(function(t, e) {
                            e.style[o["private"].animationDelay] = t * n.options.displayTypeSpeed + "ms"
                        }),
                        n.$obj.addClass("cbp-displayType-bottomToTop"),
                        n.blocksOn.last().one(o["private"].animationend, function() {
                            n.$obj.removeClass("cbp-displayType-bottomToTop"),
                                n.blocksOn.each(function(t, e) {
                                    e.style[o["private"].animationDelay] = ""
                                }),
                                t.resolve()
                        })
                }
            }, !0)
        }
        o.plugins.displayBottomToTop = function(t) {
            return o["private"].modernBrowser && "bottomToTop" === t.options.displayType && 0 !== t.blocksOn.length ? new a(t) : null
        }
    }(jQuery, window, document),
    function(n, t, e, i) {
        "use strict";
        var o = n.fn.cubeportfolio.constructor;
        function a(e) {
            e.registerEvent("initEndWrite", function() {
                if (!(e.width <= 0)) {
                    var t = n.Deferred();
                    e.pushQueue("delayFrame", t),
                        e.obj.style[o["private"].animationDuration] = e.options.displayTypeSpeed + "ms",
                        e.$obj.addClass("cbp-displayType-fadeIn"),
                        e.$obj.one(o["private"].animationend, function() {
                            e.$obj.removeClass("cbp-displayType-fadeIn"),
                                e.obj.style[o["private"].animationDuration] = "",
                                t.resolve()
                        })
                }
            }, !0)
        }
        o.plugins.displayFadeIn = function(t) {
            return !o["private"].modernBrowser || "lazyLoading" !== t.options.displayType && "fadeIn" !== t.options.displayType || 0 === t.blocksOn.length ? null : new a(t)
        }
    }(jQuery, window, document),
    function(n, t, e, i) {
        "use strict";
        var o = n.fn.cubeportfolio.constructor;
        function a(e) {
            e.registerEvent("initEndWrite", function() {
                if (!(e.width <= 0)) {
                    var t = n.Deferred();
                    e.pushQueue("delayFrame", t),
                        e.obj.style[o["private"].animationDuration] = e.options.displayTypeSpeed + "ms",
                        e.$obj.addClass("cbp-displayType-fadeInToTop"),
                        e.$obj.one(o["private"].animationend, function() {
                            e.$obj.removeClass("cbp-displayType-fadeInToTop"),
                                e.obj.style[o["private"].animationDuration] = "",
                                t.resolve()
                        })
                }
            }, !0)
        }
        o.plugins.displayFadeInToTop = function(t) {
            return o["private"].modernBrowser && "fadeInToTop" === t.options.displayType && 0 !== t.blocksOn.length ? new a(t) : null
        }
    }(jQuery, window, document),
    function(e, t, n, i) {
        "use strict";
        var o = e.fn.cubeportfolio.constructor;
        function a(n) {
            n.registerEvent("initEndWrite", function() {
                if (!(n.width <= 0)) {
                    var t = e.Deferred();
                    n.pushQueue("delayFrame", t),
                        n.blocksOn.each(function(t, e) {
                            e.style[o["private"].animationDelay] = t * n.options.displayTypeSpeed + "ms"
                        }),
                        n.$obj.addClass("cbp-displayType-sequentially"),
                        n.blocksOn.last().one(o["private"].animationend, function() {
                            n.$obj.removeClass("cbp-displayType-sequentially"),
                                n.blocksOn.each(function(t, e) {
                                    e.style[o["private"].animationDelay] = ""
                                }),
                                t.resolve()
                        })
                }
            }, !0)
        }
        o.plugins.displaySequentially = function(t) {
            return o["private"].modernBrowser && "sequentially" === t.options.displayType && 0 !== t.blocksOn.length ? new a(t) : null
        }
    }(jQuery, window, document),
    function(c, t, e, n) {
        "use strict";
        var i = c.fn.cubeportfolio.constructor;
        function o(t) {
            var e = this;
            e.parent = t,
                e.filters = c(t.options.filters),
                e.filterData = [],
                t.registerEvent("afterPlugins", function(t) {
                    e.filterFromUrl(),
                        e.registerFilter()
                }),
                t.registerEvent("resetFiltersVisual", function() {
                    var o = t.options.defaultFilter.split("|");
                    e.filters.each(function(t, e) {
                        var i = c(e).find(".cbp-filter-item");
                        i.removeClass("cbp-filter-item-active"),
                            c.each(o, function(t, e) {
                                var n = i.filter('[data-filter="' + e + '"]');
                                if (n.length)
                                    return n.addClass("cbp-filter-item-active"),
                                        o.splice(t, 1),
                                        !1
                            })
                    }),
                        t.defaultFilter = t.options.defaultFilter
                })
        }
        o.prototype.registerFilter = function() {
            var s = this
                , l = s.parent
                , p = l.defaultFilter.split("|");
            s.wrap = s.filters.find(".cbp-l-filters-dropdownWrap").on({
                "mouseover.cbp": function() {
                    c(this).addClass("cbp-l-filters-dropdownWrap-open")
                },
                "mouseleave.cbp": function() {
                    c(this).removeClass("cbp-l-filters-dropdownWrap-open")
                }
            }),
                s.filters.each(function(t, i) {
                    var e = c(i)
                        , n = "*"
                        , o = e.find(".cbp-filter-item")
                        , a = {};
                    e.hasClass("cbp-l-filters-dropdown") && (a.wrap = e.find(".cbp-l-filters-dropdownWrap"),
                        a.header = e.find(".cbp-l-filters-dropdownHeader"),
                        a.headerText = a.header.text()),
                        l.$obj.cubeportfolio("showCounter", o),
                        c.each(p, function(t, e) {
                            if (o.filter('[data-filter="' + e + '"]').length)
                                return n = e,
                                    p.splice(t, 1),
                                    !1
                        }),
                        c.data(i, "filterName", n),
                        s.filterData.push(i),
                        s.filtersCallback(a, o.filter('[data-filter="' + n + '"]'), o);
                    var r = i.getAttribute("data-filter-parent");
                    r && (e.removeClass("cbp-l-subfilters--active"),
                    r === s.parent.defaultFilter && e.addClass("cbp-l-subfilters--active")),
                        o.on("click.cbp", function() {
                            var t = c(this);
                            if (!t.hasClass("cbp-filter-item-active") && !l.isAnimating) {
                                s.filtersCallback(a, t, o),
                                    c.data(i, "filterName", t.data("filter"));
                                var e = c.map(s.filterData, function(t, e) {
                                    var n = c(t)
                                        , i = t.getAttribute("data-filter-parent");
                                    i && (i === c.data(s.filterData[0], "filterName") ? n.addClass("cbp-l-subfilters--active") : (n.removeClass("cbp-l-subfilters--active"),
                                        c.data(t, "filterName", "*"),
                                        n.find(".cbp-filter-item").removeClass("cbp-filter-item-active")));
                                    var o = c.data(t, "filterName");
                                    return "" !== o && "*" !== o ? o : null
                                });
                                e.length < 1 && (e = ["*"]);
                                var n = e.join("|");
                                l.defaultFilter !== n && l.$obj.cubeportfolio("filter", n)
                            }
                        })
                })
        }
            ,
            o.prototype.filtersCallback = function(t, e, n) {
                c.isEmptyObject(t) || (t.wrap.trigger("mouseleave.cbp"),
                    t.headerText ? t.headerText = "" : t.header.html(e.html())),
                    n.removeClass("cbp-filter-item-active"),
                    e.addClass("cbp-filter-item-active")
            }
            ,
            o.prototype.filterFromUrl = function() {
                var t = /#cbpf=(.*?)([#\?&]|$)/gi.exec(location.href);
                null !== t && (this.parent.defaultFilter = decodeURIComponent(t[1]))
            }
            ,
            o.prototype.destroy = function() {
                this.filters.find(".cbp-filter-item").off(".cbp"),
                    this.wrap.off(".cbp")
            }
            ,
            i.plugins.filters = function(t) {
                return "" === t.options.filters ? null : new o(t)
            }
    }(jQuery, window, document),
    function(o, t, e, n) {
        "use strict";
        function i(i) {
            var e = i.options.gapVertical
                , n = i.options.gapHorizontal;
            i.registerEvent("onMediaQueries", function(t) {
                i.options.gapVertical = t && t.hasOwnProperty("gapVertical") ? t.gapVertical : e,
                    i.options.gapHorizontal = t && t.hasOwnProperty("gapHorizontal") ? t.gapHorizontal : n,
                    i.blocks.each(function(t, e) {
                        var n = o(e).data("cbp");
                        n.widthAndGap = n.width + i.options.gapVertical,
                            n.heightAndGap = n.height + i.options.gapHorizontal
                    })
            })
        }
        o.fn.cubeportfolio.constructor.plugins.changeGapOnMediaQueries = function(t) {
            return new i(t)
        }
    }(jQuery, window, document),
    function(a, t, e, n) {
        "use strict";
        var i = {}
            , o = a.fn.cubeportfolio.constructor;
        function r(t) {
            var e = this;
            e.parent = t,
                e.options = a.extend({}, i, e.parent.options.plugins.inlineSlider),
                e.runInit(),
                t.registerEvent("addItemsToDOM", function() {
                    e.runInit()
                })
        }
        function s(t) {
            var e = this;
            t.hasClass("cbp-slider-inline-ready") || (t.addClass("cbp-slider-inline-ready"),
                e.items = t.find(".cbp-slider-wrapper").children(".cbp-slider-item"),
                e.active = e.items.filter(".cbp-slider-item--active").index(),
                e.total = e.items.length - 1,
                e.updateLeft(),
                t.find(".cbp-slider-next").on("click.cbp", function(t) {
                    t.preventDefault(),
                        e.active < e.total ? (e.active++,
                            e.updateLeft()) : e.active === e.total && (e.active = 0,
                            e.updateLeft())
                }),
                t.find(".cbp-slider-prev").on("click.cbp", function(t) {
                    t.preventDefault(),
                        0 < e.active ? (e.active--,
                            e.updateLeft()) : 0 === e.active && (e.active = e.total,
                            e.updateLeft())
                }))
        }
        s.prototype.updateLeft = function() {
            var n = this;
            n.items.removeClass("cbp-slider-item--active"),
                n.items.eq(n.active).addClass("cbp-slider-item--active"),
                n.items.each(function(t, e) {
                    e.style.left = t - n.active + "00%"
                })
        }
            ,
            r.prototype.runInit = function() {
                var o = this;
                o.parent.$obj.find(".cbp-slider-inline").not(".cbp-slider-inline-ready").each(function(t, e) {
                    var n = a(e)
                        , i = n.find(".cbp-slider-item--active").find("img")[0];
                    i.hasAttribute("data-cbp-src") ? o.parent.$obj.on("lazyLoad.cbp", function(t, e) {
                        e.src === i.src && new s(n)
                    }) : new s(n)
                })
            }
            ,
            r.prototype.destroy = function() {
                this.parent.$obj.find(".cbp-slider-next").off("click.cbp"),
                    this.parent.$obj.find(".cbp-slider-prev").off("click.cbp"),
                    this.parent.$obj.off("lazyLoad.cbp"),
                    this.parent.$obj.find(".cbp-slider-inline").each(function(t, e) {
                        var n = a(e);
                        n.removeClass("cbp-slider-inline-ready");
                        var i = n.find(".cbp-slider-item");
                        i.removeClass("cbp-slider-item--active"),
                            i.removeAttr("style"),
                            i.eq(0).addClass("cbp-slider-item--active")
                    })
            }
            ,
            o.plugins.inlineSlider = function(t) {
                return new r(t)
            }
    }(jQuery, window, document),
    function(a, t, e, n) {
        "use strict";
        var i = {
            loadingClass: "cbp-lazyload",
            threshold: 400
        }
            , o = a.fn.cubeportfolio.constructor
            , r = a(t);
        function s(t) {
            var e = this;
            e.parent = t,
                e.options = a.extend({}, i, e.parent.options.plugins.lazyLoad),
                t.registerEvent("initFinish", function() {
                    e.loadImages(),
                        t.registerEvent("resizeMainContainer", function() {
                            e.loadImages()
                        }),
                        t.registerEvent("filterFinish", function() {
                            e.loadImages()
                        }),
                        o["private"].lazyLoadScroll.initEvent({
                            instance: e,
                            fn: e.loadImages
                        })
                }, !0)
        }
        o["private"].lazyLoadScroll = new o["private"].publicEvents("scroll.cbplazyLoad",50),
            s.prototype.loadImages = function() {
                var o = this
                    , t = o.parent.$obj.find("img").filter("[data-cbp-src]");
                0 !== t.length && (o.screenHeight = r.height(),
                    t.each(function(t, e) {
                        var n = a(e.parentNode);
                        if (o.isElementInScreen(e)) {
                            var i = e.getAttribute("data-cbp-src");
                            null === o.parent.checkSrc(a("<img>").attr("src", i)) ? (o.removeLazyLoad(e, i),
                                n.removeClass(o.options.loadingClass)) : (n.addClass(o.options.loadingClass),
                                a("<img>").on("load.cbp error.cbp", function() {
                                    o.removeLazyLoad(e, i, n)
                                }).attr("src", i))
                        } else
                            n.addClass(o.options.loadingClass)
                    }))
            }
            ,
            s.prototype.removeLazyLoad = function(t, e, n) {
                var i = this;
                t.src = e,
                    t.removeAttribute("data-cbp-src"),
                    i.parent.removeAttrImage(t),
                    i.parent.$obj.trigger("lazyLoad.cbp", t),
                n && (o["private"].modernBrowser ? a(t).one(o["private"].transitionend, function() {
                    n.removeClass(i.options.loadingClass)
                }) : n.removeClass(i.options.loadingClass))
            }
            ,
            s.prototype.isElementInScreen = function(t) {
                var e = t.getBoundingClientRect()
                    , n = e.bottom + this.options.threshold
                    , i = this.screenHeight + n - (e.top - this.options.threshold);
                return 0 <= n && n <= i
            }
            ,
            s.prototype.destroy = function() {
                o["private"].lazyLoadScroll.destroyEvent(this)
            }
            ,
            o.plugins.lazyLoad = function(t) {
                return new s(t)
            }
    }(jQuery, window, document),
    function(r, a, t, e) {
        "use strict";
        var i = {
            element: "",
            action: "click",
            loadItems: 3
        }
            , s = r.fn.cubeportfolio.constructor;
        function n(t) {
            var n = this;
            n.parent = t,
                n.options = r.extend({}, i, n.parent.options.plugins.loadMore),
                n.loadMore = r(n.options.element).find(".cbp-l-loadMore-link"),
            0 !== n.loadMore.length && (n.loadItems = n.loadMore.find(".cbp-l-loadMore-loadItems"),
            "0" === n.loadItems.text() && n.loadMore.addClass("cbp-l-loadMore-stop"),
                t.registerEvent("filterStart", function(e) {
                    n.populateItems().then(function() {
                        var t = n.items.filter(n.parent.filterConcat(e)).length;
                        0 < t ? (n.loadMore.removeClass("cbp-l-loadMore-stop"),
                            n.loadItems.html(t)) : n.loadMore.addClass("cbp-l-loadMore-stop")
                    })
                }),
                n[n.options.action]())
        }
        n.prototype.populateItems = function() {
            var n = this;
            return n.items ? r.Deferred().resolve() : (n.items = r(),
                r.ajax({
                    url: n.loadMore.attr("href"),
                    type: "GET",
                    dataType: "HTML"
                }).done(function(t) {
                    var e = r.map(t.split(/\r?\n/), function(t, e) {
                        return r.trim(t)
                    }).join("");
                    0 !== e.length && r.each(r.parseHTML(e), function(t, e) {
                        r(e).hasClass("cbp-item") ? n.items = n.items.add(e) : r.each(e.children, function(t, e) {
                            r(e).hasClass("cbp-item") && (n.items = n.items.add(e))
                        })
                    })
                }).fail(function() {
                    n.items = null,
                        n.loadMore.removeClass("cbp-l-loadMore-loading")
                }))
        }
            ,
            n.prototype.populateInsertItems = function(t) {
                var n = this
                    , i = []
                    , o = n.parent.defaultFilter
                    , a = 0;
                n.items.each(function(t, e) {
                    if (a === n.options.loadItems)
                        return !1;
                    o && "*" !== o ? r(e).filter(n.parent.filterConcat(o)).length && (i.push(e),
                        n.items[t] = null,
                        a++) : (i.push(e),
                        n.items[t] = null,
                        a++)
                }),
                    n.items = n.items.map(function(t, e) {
                        return e
                    }),
                    0 !== i.length ? n.parent.$obj.cubeportfolio("append", i, t) : n.loadMore.removeClass("cbp-l-loadMore-loading").addClass("cbp-l-loadMore-stop")
            }
            ,
            n.prototype.click = function() {
                var n = this;
                function e() {
                    n.loadMore.removeClass("cbp-l-loadMore-loading");
                    var t, e = n.parent.defaultFilter;
                    0 === (t = e && "*" !== e ? n.items.filter(n.parent.filterConcat(e)).length : n.items.length) ? n.loadMore.addClass("cbp-l-loadMore-stop") : n.loadItems.html(t)
                }
                n.loadMore.on("click.cbp", function(t) {
                    t.preventDefault(),
                    n.parent.isAnimating || n.loadMore.hasClass("cbp-l-loadMore-stop") || (n.loadMore.addClass("cbp-l-loadMore-loading"),
                        n.populateItems().then(function() {
                            n.populateInsertItems(e)
                        }))
                })
            }
            ,
            n.prototype.auto = function() {
                var n = this
                    , i = r(a)
                    , o = !1;
                function t() {
                    if (!o && !n.loadMore.hasClass("cbp-l-loadMore-stop")) {
                        var t = n.loadMore.offset().top - 200;
                        i.scrollTop() + i.height() < t || (o = !0,
                            n.populateItems().then(function() {
                                n.populateInsertItems(e)
                            }).fail(function() {
                                o = !1
                            }))
                    }
                }
                function e() {
                    var t, e = n.parent.defaultFilter;
                    0 === (t = e && "*" !== e ? n.items.filter(n.parent.filterConcat(e)).length : n.items.length) ? n.loadMore.removeClass("cbp-l-loadMore-loading").addClass("cbp-l-loadMore-stop") : (n.loadItems.html(t),
                        i.trigger("scroll.loadMore")),
                        o = !1,
                    0 === n.items.length && (s["private"].loadMoreScroll.destroyEvent(n),
                        n.parent.$obj.off("filterComplete.cbp"))
                }
                s["private"].loadMoreScroll = new s["private"].publicEvents("scroll.loadMore",100),
                    n.parent.$obj.one("initComplete.cbp", function() {
                        n.loadMore.addClass("cbp-l-loadMore-loading").on("click.cbp", function(t) {
                            t.preventDefault()
                        }),
                            s["private"].loadMoreScroll.initEvent({
                                instance: n,
                                fn: function() {
                                    n.parent.isAnimating || t()
                                }
                            }),
                            n.parent.$obj.on("filterComplete.cbp", function() {
                                t()
                            }),
                            t()
                    })
            }
            ,
            n.prototype.destroy = function() {
                this.loadMore.off(".cbp"),
                s["private"].loadMoreScroll && s["private"].loadMoreScroll.destroyEvent(this)
            }
            ,
            s.plugins.loadMore = function(t) {
                var e = t.options.plugins;
                return t.options.loadMore && (e.loadMore || (e.loadMore = {}),
                    e.loadMore.element = t.options.loadMore),
                t.options.loadMoreAction && (e.loadMore || (e.loadMore = {}),
                    e.loadMore.action = t.options.loadMoreAction),
                e.loadMore && void 0 !== e.loadMore.selector && (e.loadMore.element = e.loadMore.selector,
                    delete e.loadMore.selector),
                    e.loadMore && e.loadMore.element ? new n(t) : null
            }
    }(jQuery, window, document),
    function(u, d, f, t) {
        "use strict";
        var l = u.fn.cubeportfolio.constructor
            , c = {
            delay: 0
        }
            , e = {
            init: function(t, e) {
                var o, a = this;
                if (a.cubeportfolio = t,
                    a.type = e,
                    a.isOpen = !1,
                    a.options = a.cubeportfolio.options,
                "lightbox" === e && (a.cubeportfolio.registerEvent("resizeWindow", function() {
                    a.resizeImage()
                }),
                    a.localOptions = u.extend({}, c, a.cubeportfolio.options.plugins.lightbox)),
                "singlePageInline" !== e) {
                    if (a.createMarkup(),
                    "singlePage" === e) {
                        if (a.cubeportfolio.registerEvent("resizeWindow", function() {
                            if (a.options.singlePageStickyNavigation) {
                                var t = a.contentWrap[0].clientWidth;
                                0 < t && (a.navigationWrap.width(t),
                                    a.navigation.width(t))
                            }
                        }),
                            a.options.singlePageDeeplinking) {
                            a.url = location.href,
                            "#" === a.url.slice(-1) && (a.url = a.url.slice(0, -1));
                            p = (l = a.url.split("#cbp=")).shift();
                            if (u.each(l, function(t, i) {
                                if (a.cubeportfolio.blocksOn.each(function(t, e) {
                                    var n = u(e).find(a.options.singlePageDelegate + '[href="' + i + '"]');
                                    if (n.length)
                                        return o = n,
                                            !1
                                }),
                                    o)
                                    return !1
                            }),
                                o) {
                                a.url = p;
                                var n = o
                                    , i = n.attr("data-cbp-singlePage")
                                    , r = [];
                                i ? r = n.closest(u(".cbp-item")).find('[data-cbp-singlePage="' + i + '"]') : a.cubeportfolio.blocksOn.each(function(t, e) {
                                    var n = u(e);
                                    n.not(".cbp-item-off") && n.find(a.options.singlePageDelegate).each(function(t, e) {
                                        u(e).attr("data-cbp-singlePage") || r.push(e)
                                    })
                                }),
                                    a.openSinglePage(r, o[0])
                            } else if (l.length) {
                                var s = f.createElement("a");
                                s.setAttribute("href", l[0]),
                                    a.openSinglePage([s], s)
                            }
                        }
                        a.localOptions = u.extend({}, c, a.cubeportfolio.options.plugins.singlePage)
                    }
                } else {
                    if (a.height = 0,
                        a.createMarkupSinglePageInline(),
                        a.cubeportfolio.registerEvent("resizeGrid", function() {
                            a.isOpen && a.close()
                        }),
                        a.options.singlePageInlineDeeplinking) {
                        a.url = location.href,
                        "#" === a.url.slice(-1) && (a.url = a.url.slice(0, -1));
                        var l, p = (l = a.url.split("#cbpi=")).shift();
                        u.each(l, function(t, i) {
                            if (a.cubeportfolio.blocksOn.each(function(t, e) {
                                var n = u(e).find(a.options.singlePageInlineDelegate + '[href="' + i + '"]');
                                if (n.length)
                                    return o = n,
                                        !1
                            }),
                                o)
                                return !1
                        }),
                        o && a.cubeportfolio.registerEvent("initFinish", function() {
                            a.openSinglePageInline(a.cubeportfolio.blocksOn, o[0])
                        }, !0)
                    }
                    a.localOptions = u.extend({}, c, a.cubeportfolio.options.plugins.singlePageInline)
                }
            },
            createMarkup: function() {
                var r = this
                    , t = "";
                if ("singlePage" === r.type && "left" !== r.options.singlePageAnimation && (t = " cbp-popup-singlePage-" + r.options.singlePageAnimation),
                    r.wrap = u("<div/>", {
                        "class": "cbp-popup-wrap cbp-popup-" + r.type + t,
                        "data-action": "lightbox" === r.type ? "close" : ""
                    }).on("click.cbp", function(t) {
                        if (!r.stopEvents) {
                            var e = u(t.target).attr("data-action");
                            r[e] && (r[e](),
                                t.preventDefault())
                        }
                    }),
                    "singlePage" === r.type ? (r.contentWrap = u("<div/>", {
                        "class": "cbp-popup-content-wrap"
                    }).appendTo(r.wrap),
                    "ios" === l["private"].browser && r.contentWrap.css("overflow", "auto"),
                        r.content = u("<div/>", {
                            "class": "cbp-popup-content"
                        }).appendTo(r.contentWrap)) : r.content = u("<div/>", {
                        "class": "cbp-popup-content"
                    }).appendTo(r.wrap),
                    u("<div/>", {
                        "class": "cbp-popup-loadingBox"
                    }).appendTo(r.wrap),
                "ie8" === l["private"].browser && (r.bg = u("<div/>", {
                    "class": "cbp-popup-ie8bg",
                    "data-action": "lightbox" === r.type ? "close" : ""
                }).appendTo(r.wrap)),
                    "singlePage" === r.type && !1 === r.options.singlePageStickyNavigation ? r.navigationWrap = u("<div/>", {
                        "class": "cbp-popup-navigation-wrap"
                    }).appendTo(r.contentWrap) : r.navigationWrap = u("<div/>", {
                        "class": "cbp-popup-navigation-wrap"
                    }).appendTo(r.wrap),
                    r.navigation = u("<div/>", {
                        "class": "cbp-popup-navigation"
                    }).appendTo(r.navigationWrap),
                    r.closeButton = u("<div/>", {
                        "class": "cbp-popup-close",
                        title: "Close (Esc arrow key)",
                        "data-action": "close"
                    }).appendTo(r.navigation),
                    r.nextButton = u("<div/>", {
                        "class": "cbp-popup-next",
                        title: "Next (Right arrow key)",
                        "data-action": "next"
                    }).appendTo(r.navigation),
                    r.prevButton = u("<div/>", {
                        "class": "cbp-popup-prev",
                        title: "Previous (Left arrow key)",
                        "data-action": "prev"
                    }).appendTo(r.navigation),
                "singlePage" === r.type) {
                    r.options.singlePageCounter && (r.counter = u(r.options.singlePageCounter).appendTo(r.navigation),
                        r.counter.text("")),
                        r.content.on("click.cbp", r.options.singlePageDelegate, function(t) {
                            t.preventDefault();
                            var e, n, i = r.dataArray.length, o = this.getAttribute("href");
                            for (e = 0; e < i; e++)
                                if (r.dataArray[e].url === o) {
                                    n = e;
                                    break
                                }
                            if (void 0 === n) {
                                var a = f.createElement("a");
                                a.setAttribute("href", o),
                                    r.dataArray = [{
                                        url: o,
                                        element: a
                                    }],
                                    r.counterTotal = 1,
                                    r.nextButton.hide(),
                                    r.prevButton.hide(),
                                    r.singlePageJumpTo(0)
                            } else
                                r.singlePageJumpTo(n - r.current)
                        });
                    var e = !1;
                    try {
                        var n = Object.defineProperty({}, "passive", {
                            get: function() {
                                e = {
                                    passive: !0
                                }
                            }
                        });
                        d.addEventListener("testPassive", null, n),
                            d.removeEventListener("testPassive", null, n)
                    } catch (o) {}
                    var i = "onwheel"in f.createElement("div") ? "wheel" : "mousewheel";
                    r.contentWrap[0].addEventListener(i, function(t) {
                        t.stopImmediatePropagation()
                    }, e)
                }
                u(f).on("keydown.cbp", function(t) {
                    r.isOpen && (r.stopEvents || (a && t.stopImmediatePropagation(),
                        37 === t.keyCode ? r.prev() : 39 === t.keyCode ? r.next() : 27 === t.keyCode && r.close()))
                })
            },
            createMarkupSinglePageInline: function() {
                var n = this;
                n.wrap = u("<div/>", {
                    "class": "cbp-popup-singlePageInline"
                }).on("click.cbp", function(t) {
                    if (!n.stopEvents) {
                        var e = u(t.target).attr("data-action");
                        e && n[e] && (n[e](),
                            t.preventDefault())
                    }
                }),
                    n.content = u("<div/>", {
                        "class": "cbp-popup-content"
                    }).appendTo(n.wrap),
                    n.navigation = u("<div/>", {
                        "class": "cbp-popup-navigation"
                    }).appendTo(n.wrap),
                    n.closeButton = u("<div/>", {
                        "class": "cbp-popup-close",
                        title: "Close (Esc arrow key)",
                        "data-action": "close"
                    }).appendTo(n.navigation)
            },
            destroy: function() {
                var t = this
                    , e = u("body");
                u(f).off("keydown.cbp"),
                    e.off("click.cbp", t.options.lightboxDelegate),
                    e.off("click.cbp", t.options.singlePageDelegate),
                    t.content.off("click.cbp", t.options.singlePageDelegate),
                    t.cubeportfolio.$obj.off("click.cbp", t.options.singlePageInlineDelegate),
                    t.cubeportfolio.$obj.off("click.cbp", t.options.lightboxDelegate),
                    t.cubeportfolio.$obj.off("click.cbp", t.options.singlePageDelegate),
                    t.cubeportfolio.$obj.removeClass("cbp-popup-isOpening"),
                    t.cubeportfolio.$obj.find(".cbp-item").removeClass("cbp-singlePageInline-active"),
                    t.wrap.remove()
            },
            openLightbox: function(t, e) {
                var s, n, l = this, p = 0, c = [];
                if (!l.isOpen) {
                    if (a = !0,
                        l.isOpen = !0,
                        l.stopEvents = !1,
                        l.dataArray = [],
                    (l.current = null) === (s = e.getAttribute("href")))
                        throw new Error("HEI! Your clicked element doesn't have a href attribute.");
                    u.each(t, function(t, e) {
                        var n, i = e.getAttribute("href"), o = i, a = "isImage";
                        if (-1 === u.inArray(i, c)) {
                            if (s === i)
                                l.current = p;
                            else if (!l.options.lightboxGallery)
                                return;
                            if (/youtu\.?be/i.test(i)) {
                                var r = i.lastIndexOf("v=") + 2;
                                1 === r && (r = i.lastIndexOf("/") + 1),
                                    n = i.substring(r),
                                /autoplay=/i.test(n) || (n += "&autoplay=1"),
                                    o = "//www.youtube.com/embed/" + (n = n.replace(/\?|&/, "?")),
                                    a = "isYoutube"
                            } else
                                /vimeo\.com/i.test(i) ? (n = i.substring(i.lastIndexOf("/") + 1),
                                /autoplay=/i.test(n) || (n += "&autoplay=1"),
                                    o = "//player.vimeo.com/video/" + (n = n.replace(/\?|&/, "?")),
                                    a = "isVimeo") : /www\.ted\.com/i.test(i) ? (o = "http://embed.ted.com/talks/" + i.substring(i.lastIndexOf("/") + 1) + ".html",
                                    a = "isTed") : /soundcloud\.com/i.test(i) ? (o = i,
                                    a = "isSoundCloud") : /(\.mp4)|(\.ogg)|(\.ogv)|(\.webm)/i.test(i) ? (o = -1 !== i.indexOf("|") ? i.split("|") : i.split("%7C"),
                                    a = "isSelfHostedVideo") : /\.mp3$/i.test(i) && (o = i,
                                    a = "isSelfHostedAudio");
                            l.dataArray.push({
                                src: o,
                                title: e.getAttribute(l.options.lightboxTitleSrc),
                                type: a
                            }),
                                p++
                        }
                        c.push(i)
                    }),
                        l.counterTotal = l.dataArray.length,
                        1 === l.counterTotal ? (l.nextButton.hide(),
                            l.prevButton.hide(),
                            l.dataActionImg = "") : (l.nextButton.show(),
                            l.prevButton.show(),
                            l.dataActionImg = 'data-action="next"'),
                        l.wrap.appendTo(f.body),
                        l.scrollTop = u(d).scrollTop(),
                        l.originalStyle = u("html").attr("style"),
                        u("html").css({
                            overflow: "hidden",
                            marginRight: d.innerWidth - u(f).width()
                        }),
                        l.wrap.addClass("cbp-popup-transitionend"),
                        l.wrap.show(),
                        n = l.dataArray[l.current],
                        l[n.type](n)
                }
            },
            openSinglePage: function(t, e) {
                var i, o = this, a = 0, r = [];
                if (!o.isOpen) {
                    if (o.cubeportfolio.singlePageInline && o.cubeportfolio.singlePageInline.isOpen && o.cubeportfolio.singlePageInline.close(),
                        o.isOpen = !0,
                        o.stopEvents = !1,
                        o.dataArray = [],
                    (o.current = null) === (i = e.getAttribute("href")))
                        throw new Error("HEI! Your clicked element doesn't have a href attribute.");
                    if (u.each(t, function(t, e) {
                        var n = e.getAttribute("href");
                        -1 === u.inArray(n, r) && (i === n && (o.current = a),
                            o.dataArray.push({
                                url: n,
                                element: e
                            }),
                            a++),
                            r.push(n)
                    }),
                        o.counterTotal = o.dataArray.length,
                        1 === o.counterTotal ? (o.nextButton.hide(),
                            o.prevButton.hide()) : (o.nextButton.show(),
                            o.prevButton.show()),
                        o.wrap.appendTo(f.body),
                        o.scrollTop = u(d).scrollTop(),
                        o.contentWrap.scrollTop(0),
                        o.wrap.show(),
                        o.finishOpen = 2,
                        o.navigationMobile = u(),
                        o.wrap.one(l["private"].transitionend, function() {
                            u("html").css({
                                overflow: "hidden",
                                marginRight: d.innerWidth - u(f).width()
                            }),
                                o.wrap.addClass("cbp-popup-transitionend"),
                            o.options.singlePageStickyNavigation && (o.wrap.addClass("cbp-popup-singlePage-sticky"),
                                o.navigationWrap.width(o.contentWrap[0].clientWidth)),
                                o.finishOpen--,
                            o.finishOpen <= 0 && o.updateSinglePageIsOpen.call(o)
                        }),
                    "ie8" !== l["private"].browser && "ie9" !== l["private"].browser || (u("html").css({
                        overflow: "hidden",
                        marginRight: d.innerWidth - u(f).width()
                    }),
                        o.wrap.addClass("cbp-popup-transitionend"),
                    o.options.singlePageStickyNavigation && (o.navigationWrap.width(o.contentWrap[0].clientWidth),
                        setTimeout(function() {
                            o.wrap.addClass("cbp-popup-singlePage-sticky")
                        }, 1e3)),
                        o.finishOpen--),
                        o.wrap.addClass("cbp-popup-loading"),
                        o.wrap.offset(),
                        o.wrap.addClass("cbp-popup-singlePage-open"),
                    o.options.singlePageDeeplinking && (o.url = o.url.split("#cbp=")[0],
                        location.href = o.url + "#cbp=" + o.dataArray[o.current].url),
                    u.isFunction(o.options.singlePageCallback) && o.options.singlePageCallback.call(o, o.dataArray[o.current].url, o.dataArray[o.current].element),
                    "ios" === l["private"].browser) {
                        var s = o.contentWrap[0];
                        s.addEventListener("touchstart", function() {
                            var t = s.scrollTop
                                , e = s.scrollHeight
                                , n = t + s.offsetHeight;
                            0 === t ? s.scrollTop = 1 : n === e && (s.scrollTop = t - 1)
                        })
                    }
                }
            },
            openSinglePageInline: function(t, e, n) {
                var i, o, a, r = this;
                if (n = n || !1,
                    r.fromOpen = n,
                    r.storeBlocks = t,
                    r.storeCurrentBlock = e,
                    r.isOpen)
                    return o = r.cubeportfolio.blocksOn.index(u(e).closest(".cbp-item")),
                        void (r.dataArray[r.current].url !== e.getAttribute("href") || r.current !== o ? r.cubeportfolio.singlePageInline.close("open", {
                            blocks: t,
                            currentBlock: e,
                            fromOpen: !0
                        }) : r.close());
                if (r.isOpen = !0,
                    r.stopEvents = !1,
                    r.dataArray = [],
                (r.current = null) === (i = e.getAttribute("href")))
                    throw new Error("HEI! Your clicked element doesn't have a href attribute.");
                if (a = u(e).closest(".cbp-item")[0],
                    t.each(function(t, e) {
                        a === e && (r.current = t)
                    }),
                    r.dataArray[r.current] = {
                        url: i,
                        element: e
                    },
                    u(r.dataArray[r.current].element).parents(".cbp-item").addClass("cbp-singlePageInline-active"),
                    r.counterTotal = t.length,
                    r.wrap.insertBefore(r.cubeportfolio.wrapper),
                    r.topDifference = 0,
                "top" === r.options.singlePageInlinePosition)
                    r.blocksToMove = t,
                        r.top = 0;
                else if ("bottom" === r.options.singlePageInlinePosition)
                    r.blocksToMove = u(),
                        r.top = r.cubeportfolio.height;
                else if ("above" === r.options.singlePageInlinePosition) {
                    var s = u(t[r.current]).data("cbp").top;
                    r.top = s,
                        t.each(function(t, e) {
                            var n = u(e).data("cbp")
                                , i = n.top
                                , o = i + n.heightAndGap;
                            s <= i || o > r.top && (r.top = o,
                                r.topDifference = r.top - s)
                        }),
                        r.blocksToMove = u(),
                        t.each(function(t, e) {
                            if (t !== r.current) {
                                var n = u(e).data("cbp");
                                n.top + n.heightAndGap > r.top && (r.blocksToMove = r.blocksToMove.add(e))
                            } else
                                r.blocksToMove = r.blocksToMove.add(e)
                        }),
                        r.top = Math.max(r.top - r.options.gapHorizontal, 0)
                } else {
                    var l = u(t[r.current]).data("cbp")
                        , p = l.top + l.heightAndGap;
                    r.top = p,
                        r.blocksToMove = u(),
                        t.each(function(t, e) {
                            var n = u(e).data("cbp")
                                , i = n.top
                                , o = i + n.height;
                            o <= p || (i >= p - n.height / 2 ? r.blocksToMove = r.blocksToMove.add(e) : p < o && i < p && (o > r.top && (r.top = o),
                            o - p > r.topDifference && (r.topDifference = o - p)))
                        })
                }
                if (r.wrap[0].style.height = r.wrap.outerHeight(!0) + "px",
                    r.deferredInline = u.Deferred(),
                    r.options.singlePageInlineInFocus) {
                    r.scrollTop = u(d).scrollTop();
                    var c = r.cubeportfolio.$obj.offset().top + r.top - 100;
                    r.scrollTop !== c ? u("html,body").animate({
                        scrollTop: c
                    }, 350).promise().then(function() {
                        r.resizeSinglePageInline(),
                            r.deferredInline.resolve()
                    }) : (r.resizeSinglePageInline(),
                        r.deferredInline.resolve())
                } else
                    r.resizeSinglePageInline(),
                        r.deferredInline.resolve();
                r.cubeportfolio.$obj.addClass("cbp-popup-singlePageInline-open"),
                    r.wrap.css({
                        top: r.top
                    }),
                r.options.singlePageInlineDeeplinking && (r.url = r.url.split("#cbpi=")[0],
                    location.href = r.url + "#cbpi=" + r.dataArray[r.current].url),
                u.isFunction(r.options.singlePageInlineCallback) && r.options.singlePageInlineCallback.call(r, r.dataArray[r.current].url, r.dataArray[r.current].element)
            },
            resizeSinglePageInline: function() {
                var n = this;
                n.height = 0 === n.top || n.top === n.cubeportfolio.height ? n.wrap.outerHeight(!0) : n.wrap.outerHeight(!0) - n.options.gapHorizontal,
                    n.height += n.topDifference,
                    n.storeBlocks.each(function(t, e) {
                        l["private"].modernBrowser ? e.style[l["private"].transform] = "" : e.style.marginTop = ""
                    }),
                    n.blocksToMove.each(function(t, e) {
                        l["private"].modernBrowser ? e.style[l["private"].transform] = "translate3d(0px, " + n.height + "px, 0)" : e.style.marginTop = n.height + "px"
                    }),
                    n.cubeportfolio.obj.style.height = n.cubeportfolio.height + n.height + "px"
            },
            revertResizeSinglePageInline: function() {
                this.deferredInline = u.Deferred(),
                    this.storeBlocks.each(function(t, e) {
                        l["private"].modernBrowser ? e.style[l["private"].transform] = "" : e.style.marginTop = ""
                    }),
                    this.cubeportfolio.obj.style.height = this.cubeportfolio.height + "px"
            },
            appendScriptsToWrap: function(i) {
                var o = this
                    , a = 0
                    , r = function(t) {
                    var e = f.createElement("script")
                        , n = t.src;
                    e.type = "text/javascript",
                        e.readyState ? e.onreadystatechange = function() {
                                "loaded" != e.readyState && "complete" != e.readyState || (e.onreadystatechange = null,
                                i[++a] && r(i[a]))
                            }
                            : e.onload = function() {
                                i[++a] && r(i[a])
                            }
                        ,
                        n ? e.src = n : e.text = t.text,
                        o.content[0].appendChild(e)
                };
                r(i[0])
            },
            updateSinglePage: function(t, e, n) {
                var i, o = this;
                o.content.addClass("cbp-popup-content").removeClass("cbp-popup-content-basic"),
                !1 === n && o.content.removeClass("cbp-popup-content").addClass("cbp-popup-content-basic"),
                o.counter && (i = u(o.getCounterMarkup(o.options.singlePageCounter, o.current + 1, o.counterTotal)),
                    o.counter.text(i.text())),
                    o.fromAJAX = {
                        html: t,
                        scripts: e
                    },
                    o.finishOpen--,
                o.finishOpen <= 0 && o.updateSinglePageIsOpen.call(o)
            },
            updateSinglePageIsOpen: function() {
                var t, e = this;
                e.wrap.addClass("cbp-popup-ready"),
                    e.wrap.removeClass("cbp-popup-loading"),
                    e.content.html(e.fromAJAX.html),
                e.fromAJAX.scripts && e.appendScriptsToWrap(e.fromAJAX.scripts),
                    e.fromAJAX = {},
                    e.cubeportfolio.$obj.trigger("updateSinglePageStart.cbp"),
                    (t = e.content.find(".cbp-slider")).length ? (t.find(".cbp-slider-item").addClass("cbp-item"),
                        e.slider = t.cubeportfolio({
                            layoutMode: "slider",
                            mediaQueries: [{
                                width: 1,
                                cols: 1
                            }],
                            gapHorizontal: 0,
                            gapVertical: 0,
                            caption: "",
                            coverRatio: ""
                        })) : e.slider = null,
                    e.checkForSocialLinks(e.content),
                    e.cubeportfolio.$obj.trigger("updateSinglePageComplete.cbp")
            },
            checkForSocialLinks: function(t) {
                this.createFacebookShare(t.find(".cbp-social-fb")),
                    this.createTwitterShare(t.find(".cbp-social-twitter")),
                    this.createGooglePlusShare(t.find(".cbp-social-googleplus")),
                    this.createPinterestShare(t.find(".cbp-social-pinterest"))
            },
            createFacebookShare: function(t) {
                t.length && !t.attr("onclick") && t.attr("onclick", "window.open('http://www.facebook.com/sharer.php?u=" + encodeURIComponent(d.location.href) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")
            },
            createTwitterShare: function(t) {
                t.length && !t.attr("onclick") && t.attr("onclick", "window.open('https://twitter.com/intent/tweet?source=" + encodeURIComponent(d.location.href) + "&text=" + encodeURIComponent(f.title) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=300'); return false;")
            },
            createGooglePlusShare: function(t) {
                t.length && !t.attr("onclick") && t.attr("onclick", "window.open('https://plus.google.com/share?url=" + encodeURIComponent(d.location.href) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=450'); return false;")
            },
            createPinterestShare: function(t) {
                if (t.length && !t.attr("onclick")) {
                    var e = ""
                        , n = this.content.find("img")[0];
                    n && (e = n.src),
                        t.attr("onclick", "window.open('http://pinterest.com/pin/create/button/?url=" + encodeURIComponent(d.location.href) + "&media=" + e + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;")
                }
            },
            updateSinglePageInline: function(t, e) {
                var n = this;
                n.content.html(t),
                e && n.appendScriptsToWrap(e),
                    n.cubeportfolio.$obj.trigger("updateSinglePageInlineStart.cbp"),
                    0 !== n.localOptions.delay ? setTimeout(function() {
                        n.singlePageInlineIsOpen.call(n)
                    }, n.localOptions.delay) : n.singlePageInlineIsOpen.call(n)
            },
            singlePageInlineIsOpen: function() {
                var e = this;
                function n() {
                    e.wrap.addClass("cbp-popup-singlePageInline-ready"),
                        e.wrap[0].style.height = "",
                        e.resizeSinglePageInline(),
                        e.cubeportfolio.$obj.trigger("updateSinglePageInlineComplete.cbp")
                }
                e.cubeportfolio.loadImages(e.wrap, function() {
                    var t = e.content.find(".cbp-slider");
                    t.length ? (t.find(".cbp-slider-item").addClass("cbp-item"),
                        t.one("initComplete.cbp", function() {
                            e.deferredInline.done(n)
                        }),
                        t.on("pluginResize.cbp", function() {
                            e.deferredInline.done(n)
                        }),
                        e.slider = t.cubeportfolio({
                            layoutMode: "slider",
                            displayType: "default",
                            mediaQueries: [{
                                width: 1,
                                cols: 1
                            }],
                            gapHorizontal: 0,
                            gapVertical: 0,
                            caption: "",
                            coverRatio: ""
                        })) : (e.slider = null,
                        e.deferredInline.done(n)),
                        e.checkForSocialLinks(e.content)
                })
            },
            isImage: function(t) {
                var e = this;
                new Image;
                e.tooggleLoading(!0),
                    e.cubeportfolio.loadImages(u('<div><img src="' + t.src + '"></div>'), function() {
                        e.updateImagesMarkup(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal)),
                            e.tooggleLoading(!1)
                    })
            },
            isVimeo: function(t) {
                var e = this;
                e.updateVideoMarkup(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            isYoutube: function(t) {
                var e = this;
                e.updateVideoMarkup(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            isTed: function(t) {
                var e = this;
                e.updateVideoMarkup(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            isSoundCloud: function(t) {
                var e = this;
                e.updateVideoMarkup(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            isSelfHostedVideo: function(t) {
                var e = this;
                e.updateSelfHostedVideo(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            isSelfHostedAudio: function(t) {
                var e = this;
                e.updateSelfHostedAudio(t.src, t.title, e.getCounterMarkup(e.options.lightboxCounter, e.current + 1, e.counterTotal))
            },
            getCounterMarkup: function(t, e, n) {
                if (!t.length)
                    return "";
                var i = {
                    current: e,
                    total: n
                };
                return t.replace(/\{\{current}}|\{\{total}}/gi, function(t) {
                    return i[t.slice(2, -2)]
                })
            },
            updateSelfHostedVideo: function(t, e, n) {
                var i;
                this.wrap.addClass("cbp-popup-lightbox-isIframe");
                var o = '<div class="cbp-popup-lightbox-iframe"><video controls="controls" height="auto" style="width: 100%">';
                for (i = 0; i < t.length; i++)
                    /(\.mp4)/i.test(t[i]) ? o += '<source src="' + t[i] + '" type="video/mp4">' : /(\.ogg)|(\.ogv)/i.test(t[i]) ? o += '<source src="' + t[i] + '" type="video/ogg">' : /(\.webm)/i.test(t[i]) && (o += '<source src="' + t[i] + '" type="video/webm">');
                o += 'Your browser does not support the video tag.</video><div class="cbp-popup-lightbox-bottom">' + (e ? '<div class="cbp-popup-lightbox-title">' + e + "</div>" : "") + n + "</div></div>",
                    this.content.html(o),
                    this.wrap.addClass("cbp-popup-ready"),
                    this.preloadNearbyImages()
            },
            updateSelfHostedAudio: function(t, e, n) {
                this.wrap.addClass("cbp-popup-lightbox-isIframe");
                var i = '<div class="cbp-popup-lightbox-iframe"><div class="cbp-misc-video"><audio controls="controls" height="auto" style="width: 75%"><source src="' + t + '" type="audio/mpeg">Your browser does not support the audio tag.</audio></div><div class="cbp-popup-lightbox-bottom">' + (e ? '<div class="cbp-popup-lightbox-title">' + e + "</div>" : "") + n + "</div></div>";
                this.content.html(i),
                    this.wrap.addClass("cbp-popup-ready"),
                    this.preloadNearbyImages()
            },
            updateVideoMarkup: function(t, e, n) {
                this.wrap.addClass("cbp-popup-lightbox-isIframe");
                var i = '<div class="cbp-popup-lightbox-iframe"><iframe src="' + t + '" frameborder="0" allowfullscreen scrolling="no"></iframe><div class="cbp-popup-lightbox-bottom">' + (e ? '<div class="cbp-popup-lightbox-title">' + e + "</div>" : "") + n + "</div></div>";
                this.content.html(i),
                    this.wrap.addClass("cbp-popup-ready"),
                    this.preloadNearbyImages()
            },
            updateImagesMarkup: function(t, e, n) {
                var i = this;
                i.wrap.removeClass("cbp-popup-lightbox-isIframe");
                var o = '<div class="cbp-popup-lightbox-figure"><img src="' + t + '" class="cbp-popup-lightbox-img" ' + i.dataActionImg + ' /><div class="cbp-popup-lightbox-bottom">' + (e ? '<div class="cbp-popup-lightbox-title">' + e + "</div>" : "") + n + "</div></div>";
                i.content.html(o),
                    i.wrap.addClass("cbp-popup-ready"),
                    i.resizeImage(),
                    i.preloadNearbyImages()
            },
            next: function() {
                this[this.type + "JumpTo"](1)
            },
            prev: function() {
                this[this.type + "JumpTo"](-1)
            },
            lightboxJumpTo: function(t) {
                var e, n = this;
                n.current = n.getIndex(n.current + t),
                    n[(e = n.dataArray[n.current]).type](e)
            },
            singlePageJumpTo: function(t) {
                var e = this;
                e.current = e.getIndex(e.current + t),
                u.isFunction(e.options.singlePageCallback) && (e.resetWrap(),
                    e.contentWrap.scrollTop(0),
                    e.wrap.addClass("cbp-popup-loading"),
                e.slider && l["private"].resize.destroyEvent(u.data(e.slider[0], "cubeportfolio")),
                    e.options.singlePageCallback.call(e, e.dataArray[e.current].url, e.dataArray[e.current].element),
                e.options.singlePageDeeplinking && (location.href = e.url + "#cbp=" + e.dataArray[e.current].url))
            },
            resetWrap: function() {
                var t = this;
                "singlePage" === t.type && t.options.singlePageDeeplinking && (location.href = t.url + "#"),
                "singlePageInline" === t.type && t.options.singlePageInlineDeeplinking && (location.href = t.url + "#")
            },
            getIndex: function(t) {
                return (t %= this.counterTotal) < 0 && (t = this.counterTotal + t),
                    t
            },
            close: function(e, t) {
                var n = this;
                function i() {
                    n.slider && l["private"].resize.destroyEvent(u.data(n.slider[0], "cubeportfolio")),
                        n.content.html(""),
                        n.wrap.detach(),
                        n.cubeportfolio.$obj.removeClass("cbp-popup-singlePageInline-open cbp-popup-singlePageInline-close"),
                        n.isOpen = !1,
                    "promise" === e && u.isFunction(t.callback) && t.callback.call(n.cubeportfolio)
                }
                function o() {
                    var t = u(d).scrollTop();
                    n.resetWrap(),
                        u(d).scrollTop(t),
                        n.options.singlePageInlineInFocus && "promise" !== e ? u("html,body").animate({
                            scrollTop: n.scrollTop
                        }, 350).promise().then(function() {
                            i()
                        }) : i()
                }
                "singlePageInline" === n.type ? "open" === e ? (n.wrap.removeClass("cbp-popup-singlePageInline-ready"),
                    u(n.dataArray[n.current].element).closest(".cbp-item").removeClass("cbp-singlePageInline-active"),
                    n.isOpen = !1,
                    n.openSinglePageInline(t.blocks, t.currentBlock, t.fromOpen)) : (n.height = 0,
                    n.revertResizeSinglePageInline(),
                    n.wrap.removeClass("cbp-popup-singlePageInline-ready"),
                    n.cubeportfolio.$obj.addClass("cbp-popup-singlePageInline-close"),
                    n.cubeportfolio.$obj.find(".cbp-item").removeClass("cbp-singlePageInline-active"),
                    l["private"].modernBrowser ? n.wrap.one(l["private"].transitionend, function() {
                        o()
                    }) : o()) : "singlePage" === n.type ? (n.resetWrap(),
                    n.stopScroll = !0,
                    n.wrap.removeClass("cbp-popup-ready cbp-popup-transitionend cbp-popup-singlePage-open cbp-popup-singlePage-sticky"),
                    u("html").css({
                        overflow: "",
                        marginRight: "",
                        position: ""
                    }),
                    u(d).scrollTop(n.scrollTop),
                "ie8" !== l["private"].browser && "ie9" !== l["private"].browser || (n.slider && l["private"].resize.destroyEvent(u.data(n.slider[0], "cubeportfolio")),
                    n.content.html(""),
                    n.wrap.detach(),
                    n.isOpen = !1),
                    n.wrap.one(l["private"].transitionend, function() {
                        n.slider && l["private"].resize.destroyEvent(u.data(n.slider[0], "cubeportfolio")),
                            n.content.html(""),
                            n.wrap.detach(),
                            n.isOpen = !1
                    })) : (a = !1,
                    n.originalStyle ? u("html").attr("style", n.originalStyle) : u("html").css({
                        overflow: "",
                        marginRight: ""
                    }),
                    u(d).scrollTop(n.scrollTop),
                n.slider && l["private"].resize.destroyEvent(u.data(n.slider[0], "cubeportfolio")),
                    n.content.html(""),
                    n.wrap.detach(),
                    n.isOpen = !1)
            },
            tooggleLoading: function(t) {
                this.stopEvents = t,
                    this.wrap[t ? "addClass" : "removeClass"]("cbp-popup-loading")
            },
            resizeImage: function() {
                if (this.isOpen) {
                    var t = this.content.find("img")
                        , e = t.parent()
                        , n = u(d).height() - (e.outerHeight(!0) - e.height()) - this.content.find(".cbp-popup-lightbox-bottom").outerHeight(!0);
                    t.css("max-height", n + "px")
                }
            },
            preloadNearbyImages: function() {
                for (var t = this, e = [t.getIndex(t.current + 1), t.getIndex(t.current + 2), t.getIndex(t.current + 3), t.getIndex(t.current - 1), t.getIndex(t.current - 2), t.getIndex(t.current - 3)], n = e.length - 1; 0 <= n; n--)
                    "isImage" === t.dataArray[e[n]].type && t.cubeportfolio.checkSrc(t.dataArray[e[n]])
            }
        };
        function n(t) {
            var e = this;
            !1 === (e.parent = t).options.lightboxShowCounter && (t.options.lightboxCounter = ""),
            !1 === t.options.singlePageShowCounter && (t.options.singlePageCounter = ""),
                t.registerEvent("initStartRead", function() {
                    e.run()
                }, !0)
        }
        var a = !1
            , i = !1
            , o = !1;
        n.prototype.run = function() {
            var r = this
                , s = r.parent
                , t = u(f.body);
            s.lightbox = null,
            s.options.lightboxDelegate && !i && (i = !0,
                s.lightbox = Object.create(e),
                s.lightbox.init(s, "lightbox"),
                t.on("click.cbp", s.options.lightboxDelegate, function(t) {
                    t.preventDefault();
                    var e = u(this)
                        , i = e.attr("data-cbp-lightbox")
                        , n = r.detectScope(e)
                        , o = n.data("cubeportfolio")
                        , a = [];
                    o ? o.blocksOn.each(function(t, e) {
                        var n = u(e);
                        n.not(".cbp-item-off") && n.find(s.options.lightboxDelegate).each(function(t, e) {
                            i ? u(e).attr("data-cbp-lightbox") === i && a.push(e) : a.push(e)
                        })
                    }) : a = i ? n.find(s.options.lightboxDelegate + "[data-cbp-lightbox=" + i + "]") : n.find(s.options.lightboxDelegate),
                        s.lightbox.openLightbox(a, e[0])
                })),
                s.singlePage = null,
            s.options.singlePageDelegate && !o && (o = !0,
                s.singlePage = Object.create(e),
                s.singlePage.init(s, "singlePage"),
                t.on("click.cbp", s.options.singlePageDelegate, function(t) {
                    t.preventDefault();
                    var e = u(this)
                        , i = e.attr("data-cbp-singlePage")
                        , n = r.detectScope(e)
                        , o = n.data("cubeportfolio")
                        , a = [];
                    o ? o.blocksOn.each(function(t, e) {
                        var n = u(e);
                        n.not(".cbp-item-off") && n.find(s.options.singlePageDelegate).each(function(t, e) {
                            i ? u(e).attr("data-cbp-singlePage") === i && a.push(e) : a.push(e)
                        })
                    }) : a = i ? n.find(s.options.singlePageDelegate + "[data-cbp-singlePage=" + i + "]") : n.find(s.options.singlePageDelegate),
                        s.singlePage.openSinglePage(a, e[0])
                })),
                s.singlePageInline = null,
            s.options.singlePageInlineDelegate && (s.singlePageInline = Object.create(e),
                s.singlePageInline.init(s, "singlePageInline"),
                s.$obj.on("click.cbp", s.options.singlePageInlineDelegate, function(t) {
                    t.preventDefault();
                    var e = u.data(this, "cbp-locked")
                        , n = u.data(this, "cbp-locked", +new Date);
                    (!e || 300 < n - e) && s.singlePageInline.openSinglePageInline(s.blocksOn, this)
                }))
        }
            ,
            n.prototype.detectScope = function(t) {
                var e, n, i;
                return (e = t.closest(".cbp-popup-singlePageInline")).length ? (i = t.closest(".cbp", e[0])).length ? i : e : (n = t.closest(".cbp-popup-singlePage")).length ? (i = t.closest(".cbp", n[0])).length ? i : n : (i = t.closest(".cbp")).length ? i : u(f.body)
            }
            ,
            n.prototype.destroy = function() {
                var t = this.parent;
                u(f.body).off("click.cbp"),
                    o = i = !1,
                t.lightbox && t.lightbox.destroy(),
                t.singlePage && t.singlePage.destroy(),
                t.singlePageInline && t.singlePageInline.destroy()
            }
            ,
            l.plugins.popUp = function(t) {
                return new n(t)
            }
    }(jQuery, window, document),
    function(s, t, e, n) {
        "use strict";
        var i = s.fn.cubeportfolio.constructor;
        function o(t) {
            var n = this;
            n.parent = t,
                n.searchInput = s(t.options.search),
                n.searchInput.each(function(t, e) {
                    var n = e.getAttribute("data-search");
                    n || (n = "*"),
                        s.data(e, "searchData", {
                            value: e.value,
                            el: n
                        })
                });
            var i = null;
            n.searchInput.on("keyup.cbp paste.cbp", function(t) {
                t.preventDefault();
                var e = s(this);
                clearTimeout(i),
                    i = setTimeout(function() {
                        n.runEvent.call(n, e)
                    }, 350)
            }),
                n.searchNothing = n.searchInput.siblings(".cbp-search-nothing").detach(),
                n.searchNothingHeight = null,
                n.searchNothingHTML = n.searchNothing.html(),
                n.searchInput.siblings(".cbp-search-icon").on("click.cbp", function(t) {
                    t.preventDefault(),
                        n.runEvent.call(n, s(this).prev().val(""))
                })
        }
        o.prototype.runEvent = function(t) {
            var i = this
                , o = t.val()
                , a = t.data("searchData")
                , r = new RegExp(o,"i");
            a.value === o || i.parent.isAnimating || (0 < (a.value = o).length ? t.attr("value", o) : t.removeAttr("value"),
                i.parent.$obj.cubeportfolio("filter", function(t) {
                    var e = t.filter(function(t, e) {
                        if (-1 < s(e).find(a.el).text().search(r))
                            return !0
                    });
                    if (0 === e.length && i.searchNothing.length) {
                        var n = i.searchNothingHTML.replace("{{query}}", o);
                        i.searchNothing.html(n),
                            i.searchNothing.appendTo(i.parent.$obj),
                        null === i.searchNothingHeight && (i.searchNothingHeight = i.searchNothing.outerHeight(!0)),
                            i.parent.registerEvent("resizeMainContainer", function() {
                                i.parent.height = i.parent.height + i.searchNothingHeight,
                                    i.parent.obj.style.height = i.parent.height + "px"
                            }, !0)
                    } else
                        i.searchNothing.detach();
                    return i.parent.triggerEvent("resetFiltersVisual"),
                        e
                }, function() {
                    t.trigger("keyup.cbp")
                }))
        }
            ,
            o.prototype.destroy = function() {
                this.searchInput.off(".cbp"),
                    this.searchInput.next(".cbp-search-icon").off(".cbp"),
                    this.searchInput.each(function(t, e) {
                        s.removeData(e)
                    })
            }
            ,
            i.plugins.search = function(t) {
                return "" === t.options.search ? null : new o(t)
            }
    }(jQuery, window, document),
    function(o, t, e, n) {
        "use strict";
        var i = {
            pagination: "",
            paginationClass: "cbp-pagination-active"
        }
            , a = o.fn.cubeportfolio.constructor;
        function r(t) {
            var e = this;
            e.parent = t,
                e.options = o.extend({}, i, e.parent.options.plugins.slider);
            var n = o(e.options.pagination);
            0 < n.length && (e.parent.customPagination = n,
                e.parent.customPaginationItems = n.children(),
                e.parent.customPaginationClass = e.options.paginationClass,
                e.parent.customPaginationItems.on("click.cbp", function(t) {
                    t.preventDefault(),
                        t.stopImmediatePropagation(),
                        t.stopPropagation(),
                    e.parent.sliderStopEvents || e.parent.jumpToSlider(o(this))
                })),
                e.parent.registerEvent("gridAdjust", function() {
                    e.sliderMarkup.call(e.parent),
                        e.parent.registerEvent("gridAdjust", function() {
                            e.updateSlider.call(e.parent)
                        })
                }, !0)
        }
        r.prototype.sliderMarkup = function() {
            var i = this;
            i.sliderStopEvents = !1,
                i.sliderActive = 0,
                i.$obj.one("initComplete.cbp", function() {
                    i.$obj.addClass("cbp-mode-slider")
                }),
                i.nav = o("<div/>", {
                    "class": "cbp-nav"
                }),
                i.nav.on("click.cbp", "[data-slider-action]", function(t) {
                    if (t.preventDefault(),
                        t.stopImmediatePropagation(),
                        t.stopPropagation(),
                        !i.sliderStopEvents) {
                        var e = o(this)
                            , n = e.attr("data-slider-action");
                        i[n + "Slider"] && i[n + "Slider"](e)
                    }
                }),
            i.options.showNavigation && (i.controls = o("<div/>", {
                "class": "cbp-nav-controls"
            }),
                i.navPrev = o("<div/>", {
                    "class": "cbp-nav-prev",
                    "data-slider-action": "prev"
                }).appendTo(i.controls),
                i.navNext = o("<div/>", {
                    "class": "cbp-nav-next",
                    "data-slider-action": "next"
                }).appendTo(i.controls),
                i.controls.appendTo(i.nav)),
            i.options.showPagination && (i.navPagination = o("<div/>", {
                "class": "cbp-nav-pagination"
            }).appendTo(i.nav)),
            (i.controls || i.navPagination) && i.nav.appendTo(i.$obj),
                i.updateSliderPagination(),
            i.options.auto && (i.options.autoPauseOnHover && (i.mouseIsEntered = !1,
                i.$obj.on("mouseenter.cbp", function(t) {
                    i.mouseIsEntered = !0,
                        i.stopSliderAuto()
                }).on("mouseleave.cbp", function(t) {
                    i.mouseIsEntered = !1,
                        i.startSliderAuto()
                })),
                i.startSliderAuto()),
            i.options.drag && a["private"].modernBrowser && i.dragSlider()
        }
            ,
            r.prototype.updateSlider = function() {
                this.updateSliderPosition(),
                    this.updateSliderPagination()
            }
            ,
            r.prototype.destroy = function() {
                var t = this;
                t.parent.customPaginationItems && t.parent.customPaginationItems.off(".cbp"),
                (t.parent.controls || t.parent.navPagination) && (t.parent.nav.off(".cbp"),
                    t.parent.nav.remove())
            }
            ,
            a.plugins.slider = function(t) {
                return "slider" !== t.options.layoutMode ? null : new r(t)
            }
    }(jQuery, window, document),
    function(u, t, e, n) {
        "use strict";
        var i = {
            element: ""
        }
            , o = u.fn.cubeportfolio.constructor;
        function a(e) {
            var n = this;
            n.parent = e,
                n.options = u.extend({}, i, n.parent.options.plugins.sort),
                n.element = u(n.options.element),
            0 !== n.element.length && (n.sort = "",
                n.sortBy = "string:asc",
                n.element.on("click.cbp", ".cbp-sort-item", function(t) {
                    t.preventDefault(),
                        n.target = t.target,
                    u(n.target).hasClass("cbp-l-dropdown-item--active") || e.isAnimating || (n.processSort(),
                        e.$obj.cubeportfolio("filter", e.defaultFilter))
                }),
                e.registerEvent("triggerSort", function() {
                    n.target && (n.processSort(),
                        e.$obj.cubeportfolio("filter", e.defaultFilter))
                }),
                n.dropdownWrap = n.element.find(".cbp-l-dropdown-wrap").on({
                    "mouseover.cbp": function() {
                        u(this).addClass("cbp-l-dropdown-wrap--open")
                    },
                    "mouseleave.cbp": function() {
                        u(this).removeClass("cbp-l-dropdown-wrap--open")
                    }
                }),
                n.dropdownHeader = n.element.find(".cbp-l-dropdown-header"))
        }
        a.prototype.processSort = function() {
            var o = this
                , t = o.parent
                , e = (p = o.target).hasAttribute("data-sort")
                , n = p.hasAttribute("data-sortBy");
            if (e && n)
                o.sort = p.getAttribute("data-sort"),
                    o.sortBy = p.getAttribute("data-sortBy");
            else if (e)
                o.sort = p.getAttribute("data-sort");
            else {
                if (!n)
                    return;
                o.sortBy = p.getAttribute("data-sortBy")
            }
            var i = o.sortBy.split(":")
                , a = "string"
                , r = 1;
            if ("int" === i[0] ? a = "int" : "float" === i[0] && (a = "float"),
            "desc" === i[1] && (r = -1),
                o.sort) {
                var s = [];
                t.blocks.each(function(t, e) {
                    var n = u(e)
                        , i = n.find(o.sort).text();
                    "int" === a && (i = parseInt(i, 10)),
                    "float" === a && (i = parseFloat(i, 10)),
                        s.push({
                            sortText: i,
                            data: n.data("cbp")
                        })
                }),
                    s.sort(function(t, e) {
                        var n = t.sortText
                            , i = e.sortText;
                        return "string" === a && (n = n.toUpperCase(),
                            i = i.toUpperCase()),
                            n < i ? -r : i < n ? r : 0
                    }),
                    u.each(s, function(t, e) {
                        e.data.index = t
                    })
            } else {
                var l = [];
                -1 === r && (t.blocks.each(function(t, e) {
                    l.push(u(e).data("cbp").indexInitial)
                }),
                    l.sort(function(t, e) {
                        return e - t
                    })),
                    t.blocks.each(function(t, e) {
                        var n = u(e).data("cbp");
                        n.index = -1 === r ? l[n.indexInitial] : n.indexInitial
                    })
            }
            t.sortBlocks(t.blocks, "index"),
                o.dropdownWrap.trigger("mouseleave.cbp");
            var p = u(o.target)
                , c = u(o.target).parent();
            if (c.hasClass("cbp-l-dropdown-list"))
                o.dropdownHeader.html(p.html()),
                    p.addClass("cbp-l-dropdown-item--active").siblings(".cbp-l-dropdown-item").removeClass("cbp-l-dropdown-item--active");
            else if (c.hasClass("cbp-l-direction")) {
                0 === p.index() ? c.addClass("cbp-l-direction--second").removeClass("cbp-l-direction--first") : c.addClass("cbp-l-direction--first").removeClass("cbp-l-direction--second")
            }
        }
            ,
            a.prototype.destroy = function() {
                this.element.off("click.cbp")
            }
            ,
            o.plugins.sort = function(t) {
                return new a(t)
            }
    }(jQuery, window, document);
