using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Tower
{
    public partial class Form1 : Form
    {
        const int SIZE = 201;
        const int HEIGHT = 10000;

        Color[] colors = { Color.White, Color.Yellow, Color.Orange, Color.Red, Color.Black };

        int count = 0;
        int maxHeight = HEIGHT;

        Bitmap field = new Bitmap(SIZE, SIZE);

        int[,] tower = new int[SIZE, SIZE];

        public Form1()
        {
            tower[SIZE/2, SIZE/2] = HEIGHT;
            InitializeComponent();
            this.Width = SIZE+16;
            this.Height = SIZE+32;
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            timer1.Start();
        }

        private void updateTower()
        {
            maxHeight = 0;
            for (int x = 0; x < SIZE; x++)
            {
                for (int y = 0; y < SIZE; y++)
                {
                    if (tower[x, y] > 3)
                    {
                        tower[x, y] -= 4;
                        tower[x - 1, y]++;
                        tower[x + 1, y]++;
                        tower[x, y-1]++;
                        tower[x, y+1]++;
                    }
                    if (tower[x,y]>maxHeight)
                    {
                        maxHeight = tower[x, y];
                    }

                }
            }
        }

        private void paintTower()
        {
            for (int x = 0; x < field.Width; x++)
            {
                for (int y=0; y<field.Height; y++)
                {
                    int c = tower[x, y];
                    if (c > 3) c = 3;
                    field.SetPixel(x, y, colors[c]);
                }
            }
            this.Refresh();
        }

        private void Form1_Paint(object sender, PaintEventArgs e)
        {
            e.Graphics.DrawImage(field, new Point(0,0));
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            count++;
            this.Text = count.ToString() + " - " + maxHeight;
            updateTower();
            paintTower();
        }
    }
}
