import java.net.*;
import java.util.ArrayList;

public class server {
    public static void main(String[] args) {

        try {
            ServerSocket server = new ServerSocket(5000);
            System.out.println("server start!");
            System.out.println("waiting....");
            ArrayList<clienthandler> clients = new ArrayList<>();

            while (true) {
                Socket socket = server.accept();
                clienthandler handler = new clienthandler(socket, clients);
                clients.add(handler);
                handler.start();
                System.out.println(clients.size() + " Client connected");

            }

        } catch (Exception e) {
            System.out.println("server Exception");

        }
    }
}


//server = serversocket 
//client = socket 

//socket only communicate with serversocket 
//each client is each socket 
//so clients cannot communciate with each other 
//client1 can only send and receive a msg from  client 2 by server 
//server know every client by socket 
//so server send a client details to clienthandler 
//the clienthandler work is get msg from one client and send to others 
//now thread 
//the thread used to run the different program at a time 
//the clienthandler run the clients through thread so every client can run at a time 
//why thread , without thread  you can run a client program one time only 
//for multiple user or action we use thread 
//