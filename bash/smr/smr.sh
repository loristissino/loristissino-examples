#!/bin/bash

# A simple bash script that makes some video filtering, scaling and
# copying the frames with a linear movement

. smr.rc

TEMPDIR=`mktemp -d`
cd $TEMPDIR

mplayer -vo jpeg $SOURCEVIDEO

FRAMES=`ls | wc -l`

mkdir back target temp
convert -size ${SWIDTH}x${SHEIGHT} xc:green back/background.png

COUNT=0

for IMAGE in *jpg; do
  let "COUNT+=1" 
  echo $COUNT
  W=`echo "($COUNT - 1) * ($TWIDTH - $SWIDTH) / ($FRAMES -1) + $SWIDTH" | bc`
  H=`echo "($COUNT - 1) * ($THEIGHT - $SHEIGHT) / ($FRAMES -1) + $SHEIGHT" | bc`
  T=`echo "($COUNT - 1) * ($TTOP - $STOP) / ($FRAMES -1) + $STOP" | bc`
  L=`echo "($COUNT - 1) * ($TLEFT - $SLEFT) / ($FRAMES -1) + $SLEFT" | bc`

  composite -geometry ${W}x${H}+${L}+${T} $IMAGE back/background.png target/$IMAGE

done

cd target

mencoder mf://*.jpg -mf fps=$FPS -o $TARGETVIDEO -ovc lavc -lavcopts vcodec=mpeg4
