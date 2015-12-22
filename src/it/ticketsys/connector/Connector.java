package it.ticketsys.connector;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class Connector {
	private Connection conn;
	private Statement stmnt;
	private ResultSet result;

	public Connector() {

		// Load the mysql driver
		try {
			loadDriver();
		} catch (InstantiationException | IllegalAccessException | ClassNotFoundException e) {
			e.printStackTrace();
		}

		// Create a new connection
		try {
			conn = connect();
			System.out.println("Connected !");
		} catch (SQLException e) {
			System.out.println("SQLException: " + e.getMessage());
			System.out.println("SQLState: " + e.getSQLState());
			System.out.println("VendorError: " + e.getErrorCode());
		}

	}

	private Connection connect() throws SQLException {
		String db_path = "jdbc:mysql://192.168.56.101/ticketsys_db";

		return DriverManager.getConnection(db_path, "moderator", "1234");

	}

	public ResultSet executeQuery(String query) {
		try {
			stmnt = conn.createStatement();
			result = stmnt.executeQuery(query);
		} catch (SQLException e) {
			System.out.println("SQLException: " + e.getMessage());
			System.out.println("SQLState: " + e.getSQLState());
			System.out.println("VendorError: " + e.getErrorCode());
		} finally {
			if (result != null) {
				try {
					result.close();
				} catch (SQLException e) {
					// ignore
				}
				result = null;
			}
			if (stmnt != null) {
				try {
					stmnt.close();
				} catch (SQLException e) {
					// ignore
				}
				stmnt = null;
			}
		}
		try {
			conn.close();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return result;

	}

	private void loadDriver() throws InstantiationException, IllegalAccessException, ClassNotFoundException {
		Class.forName("com.mysql.jdbc.Driver");
	}

}
