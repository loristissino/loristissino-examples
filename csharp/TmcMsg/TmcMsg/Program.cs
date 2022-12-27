using System;

namespace TmcMsg
{
    internal class Program
    {

        static async void Run()
        {
            TmcMessenger tizioMessenger = new TmcMessenger("161948696446");  // tizio alfa
            TmcMessenger caioMessenger = new TmcMessenger("161988421952");  // caio beta
            Console.WriteLine(await tizioMessenger.SendMessage("caio.beta", "Hello from Tizio!") ? "sent" : "not sent");
            List<TmcMessage> messages = await caioMessenger.GetMessages();
            Console.WriteLine("count: " + messages.Count);
            foreach(TmcMessage message in messages)
            {
                Console.WriteLine(message);
            }
            Console.WriteLine(await tizioMessenger.CleanUp());
            //Console.WriteLine(response);
        }

        static void Main(string[] args)
        {
            Run();
            Console.ReadLine();
        }


    }
}