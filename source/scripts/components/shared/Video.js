import * as React from "react";
import Picture from "./Picture";

const Video = ({picture, videoUrl}) => {

  return (
    <div className="c-video">
      <div className="c-video__fallback">
        <Picture images={picture.images} alt={picture.alt} title={picture.title} type="cover" />
      </div>
      <video className="c-video__player"
             poster={picture.images.desktop}
             src={videoUrl}  loop autoPlay muted />
    </div>
  )
};

export default Video;


