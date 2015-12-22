package it.ticketsys.main;

import it.ticketsys.connector.Connector;

public class ClientMain {

	public static void main(String[] args) {
		Connector con = new Connector();
		System.out.println(con.executeQuery("SELECT * FROM ticketsys_db.User;"));

	}

	public ClientMain() {
	}

}
