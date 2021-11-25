import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import javax.imageio.ImageIO;

public class Main {

    public static void main(String[] args) {
        String fileName ="test.png";
        try {
            System.out.format("Generating %s... ", fileName);
            BufferedImage bufferedImage;
            Graphics2D g2d;
            int width = 200;
            int height = 300;
            bufferedImage = new BufferedImage(width, height, BufferedImage.TYPE_INT_RGB);
            g2d = bufferedImage.createGraphics();
            g2d.setColor(Color.YELLOW);
            g2d.fillRect(10, 20, 30, 40);
            g2d.setColor(Color.BLUE);
            g2d.fillOval(60, 30, 20, 30);
            g2d.dispose();
            File file = new File(fileName);
            ImageIO.write(bufferedImage, "png", file);
            System.out.println("done.");
        }
        catch (Exception e)
        {
            System.out.println("We had some problems...");
            System.out.println(e.getMessage());
        }
    }
}
