import Snap from "snapsvg";
const SVG_FILE = "/media/maps/global-shapes.svg";

const LABEL_OFFSET = 12;
const PALLETTE = {
  brand: "#D7B56D",
  active: "#EEE4D1",
  soft: "#F8F9FB",
  light: "#FFFFFF",
};

const calcLabelPosition = (width, itemBox, baseCX, labelPosition) => {
  if(labelPosition === 'left') {
    return `translate(${itemBox.cx - width - LABEL_OFFSET} ${itemBox.cy - 12})`
  } else {
    return `translate(${itemBox.cx + LABEL_OFFSET} ${itemBox.cy - 12})`;
  }
};

const calcLineCurve = (itemCX, baseCX, base) => {
  if(itemCX <= baseCX) {
    return base - 20;
  } else {
    return base + 20;
  }
};

export const addPoint = (group, box) => {
  group.circle({
    cx: box.cx,
    cy: box.cy,
    r: 6,
    fill: PALLETTE.brand
  })
};

export const addBasePoint = (group, box) => {
  const outside = group.circle({
    cx: box.cx,
    cy: box.cy,
    r: 8,
    stroke: PALLETTE.brand,
    strokeWidth: 1,
    fill: PALLETTE.soft
  });

  const inside = group.circle({
    cx: box.cx,
    cy: box.cy,
    r: 4,
    stroke: PALLETTE.brand,
    strokeWidth: 4,
    fill: PALLETTE.soft
  })
};

export const addLabel = (group, title, itemBox, baseCX, labelPosition) => {

  const titleGroup = group.g({
    class: "label",
  });

  const rect = titleGroup.rect(0,0, 10, 24);
  const text = titleGroup.text(0,0, title);

  const textBox = text.getBBox();

  rect.attr({
    fill: PALLETTE.brand,
    width: textBox.width + 16
  });

  text.attr({
    x: 8,
    y: 16,
    fill: PALLETTE.light
  });

  titleGroup.attr({
    transform: calcLabelPosition(textBox.width + 16, itemBox, baseCX, labelPosition)
  })

};

export const addPlanPoint = (group, box) => {
  group.circle({
    class: "plan-point",
    cx: box.cx,
    cy: box.cy,
    r: 6,
    fill: PALLETTE.soft,
    stroke: PALLETTE.brand,
    strokeWidth: 2
  })
};

export const setActive = (fragment, item) => {
  fragment.group(item);
  item.attr({
    fill: PALLETTE.active,
  });
};

export const setPlan = (fragment, item, pattern) => {
  fragment.group(item);
  item.attr({
    class: "plan-shape",
    fill: pattern,
  });
};

export const getBase = (fragment) => {
  const base = fragment.select(`#ukraine`);
  const box = base.getBBox();
  return {
    cx: box.cx,
    cy: box.cy
  }
};

export const getCountriesSVG = () => {

  return new Promise((resolve, reject) => {

    Snap.load(SVG_FILE, (fragment) => {
      const shapes = fragment.select("#global-shapes");
      resolve(shapes);

      reject({
        type: "Load Error",
        message: "Nothing to show"
      })
    })
  })
};

export const addLine = (group, start, end) => {
  const pathLine = group.path(`M${start.cx} ${start.cy} L${end.cx} ${end.cy}`);
  const lineBox = pathLine.getBBox();

  pathLine.attr({
    d: `M${start.cx} ${start.cy} S${calcLineCurve(start.cx, end.cx, lineBox.cx)} ${lineBox.cy} ${end.cx} ${end.cy}`,
    stroke: PALLETTE.brand,
    strokeWidth: 2,
    strokeDasharray: "2, 4",
    strokeLinecap: "round",
    class: "line"
  });
};
