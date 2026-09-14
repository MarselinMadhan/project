import java.io.DataInputStream;

import java.io.DataOutputStream;
import java.net.Socket;
import java.util.ArrayList;

public class clienthandler extends Thread {
    DataInputStream in;
    DataOutputStream out;
    Socket socket;
    ArrayList<clienthandler> clients;
    String username;

    clienthandler(Socket socket, ArrayList<clienthandler> clients) {
        this.socket = socket;
        this.clients = clients;
    }

    void sendmessage(String msg) {
        try {
            out.writeUTF(msg);
            out.flush();
        } catch (Exception e) {
            System.out.println(e);
        }
    }

    public void run() { //what are the elements are present in the run() that run in a new thread 
        try {
            in = new DataInputStream(socket.getInputStream()); // for get a msg from client
            out = new DataOutputStream(socket.getOutputStream());// for send a msg to other client 

            username = in.readUTF();
            while (true) {
                String msg = in.readUTF();
                if (msg.equals("/EXIT")) {
                    break;

                }
                for (clienthandler client : clients) {
                    if (client != this) {
                        client.sendmessage(username + " : " + msg);
                    }

                }

            }

            for (clienthandler client : clients) {
                    if (client != this) {
                        client.sendmessage(username + " Disconnected ");
                    }

                }

            clients.remove(this);
            System.out.println("1 client disconnected");
            System.out.println( clients.size() +" clients connected now");
            in.close();
            out.close();
            socket.close();

        } catch (Exception e) {
            System.out.println("Client disconnected");
            clients.remove(this);

        }

    }
}
